<?php

namespace App\Http\Controllers\Api;

use App\Api\User;
use EasyWeChat\Factory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

class WeChatController extends Controller
{

    //获取用户session信息
    public function getSession(Request $request){


        $app = Factory::miniProgram(config('wechat.mini_program.default'));
        $res = $app->auth->session($request->code);

        $session_id = md5($res['session_key'].$res['openid']);
        $session = json_encode(['session_key'=>$res['session_key'],'openid'=>$res['openid']]);
        //保存session_key 1年
        Redis::setex('session_id:'.$session_id,86400*365, $session);

        //return ['code'=>0,'msg' =>'','data'=>['session_id'=>$session_id] ];
        return response(['code'=>1,'msg' =>'' ])
            ->withHeaders([
                'session_id' => $session_id,
            ]);

    }

    public function getSessionKey(Request $request){

        $key = 'session_id:'.$request->session_id;

        //判断KEY 是否存在
        if(!Redis::exists($key)){
            return ['code'=>-1];
        }

        $session = Redis::get($key);
        $arr = json_decode($session,true);
        $sessionKey = $arr['session_key'];
        return ['code'=>1,'msg' =>'','data'=>['session_key'=>$sessionKey] ];
    }


    //获取用户信息
    public function getUserInfo(Request $request){
        $app = Factory::miniProgram(config('wechat.mini_program.default'));
        $result = $app->encryptor->decryptData($request->session_key, $request->iv, $request->encryptData);

        //return $decryptedData;
        //创建或更新用户信息
        User::updateOrCreate(['open_id'=>$result['openId']],[
            'avatar_url' => $result['avatarUrl'],
            'city' => $result['city'],
            'country' => $result['country'],
            'gender' => $result['gender'],
            'language' => $result['language'],
            'nick_name' => base64_encode($result['nickName']),
            'open_id' => $result['openId'],
            'province' => $result['province'],
            'mobile'=>$result['phoneNumber']
        ]);

        return ['code'=>1,'msg' =>'' ];
    }

    //统一下单
    public function createPay($params){
        $app = Factory::payment(config('wechat.payment.default'));

        $result = $app->order->unify([
            'body' => $params['body'],
            'out_trade_no' => $params['out_trade_no'],
            'total_fee' => $params['total_fee'],
            'trade_type' => 'JSAPI',
            'openid' => $params['openid'],
        ]);



        if($result['return_code'] != 'SUCCESS' || $result['return_msg'] != 'OK'){
            return ['code'=>0,'msg' =>json_encode($result)];
        }

        $payment = Factory::payment(config('wechat.payment.default'));

        $jssdk = $payment->jssdk;

        $json = $jssdk->bridgeConfig($result['prepay_id']);

        return $json;
    }


    //支付回调
    public function notice(){
        $app = Factory::payment(config('wechat.payment.default'));
        $response = $app->handlePaidNotify(function ($message, $fail) {

            Log::info('微信回调数据',$message);

            //获取订单信息
            if($message['out_trade_no']{0} == 'C'){
                $order = CutOrder::where('order_sn',$message['out_trade_no'])->first();
            }else{
                $order = Order::where('order_sn',$message['out_trade_no'])->first();
            }



            if (!$order || $order->pay_status == 1) { // 如果订单不存在 或者 订单已经支付过了
                return true; // 告诉微信，我已经处理完了，订单没找到，别再通知我了
            }


            if ($message['return_code'] === 'SUCCESS') { // return_code 表示通信状态，不代表支付状态
                // 用户是否支付成功
                if (array_get($message, 'result_code') === 'SUCCESS') {

                    //写入支付日志
                    $payLog = PayLog::create([
                        'sign' =>  $message['sign'],
                        'nonce_str' =>  $message['nonce_str'],
                        'openid' =>  $message['openid'],
                        'trade_type' =>  $message['trade_type'],
                        'bank_type' =>  $message['bank_type'],
                        'total_fee' =>  $message['total_fee'],
                        'fee_type' =>  $message['fee_type'],
                        'transaction_id' =>  $message['transaction_id'],
                        'out_trade_no' =>  $message['out_trade_no'],
                        'time_end' =>  $message['time_end'],
                        'user_id' =>  $order->user_id,
                        'order_id' =>  $order->id,
                    ]);

                    if($message['out_trade_no']{0} == 'C'){
                        $order->pay_status = 1;
                        $order->order_status = 2;
                        $order->pay_time = time();
                        $order->save();

                    }else{
                        //更新订单信息
                        $order->pay_status = 1;
                        $order->pay_time = time();
                        $order->save();
                    }


                    Log::error('支付成功: pay_id:'.$payLog->id);

                    // 用户支付失败
                } elseif (array_get($message, 'result_code') === 'FAIL') {
                    Log::error('支付失败: 错误代码'.$message['err_code'].'; 错误代码描述	:.'.$message['err_code_des']);
                    //支付失败
                    $order->pay_status = 2;
                    $order->pay_time = time();
                    $order->save();


                }
            } else {
                return $fail('通信失败，请稍后再通知我');
            }


            return true; // 返回处理完成
        });

        return $response;
    }

/*    public function sendMessage($onepid,$url,$formId,$msg1,$msg2){
        $app = Factory::miniProgram(config('wechat.mini_program.default'));
        $res = $app->template_message->send([
            'touser' => $onepid,
            'template_id' => 'ORGTXcAMiZS72qzZtEalH1JnT4iSvfhhqV_0Y20K0E8',
            'page' => $url,
            'form_id' => $formId,
            'data' => [
                'keyword1' => $msg1,
                'keyword2' => $msg2,
            ],
        ]);

        return $res;

    }*/

    //退款
    /*public function refund($orderSn,$refundSn,$totalFee,$refundFee,$remark){

        $app = Factory::payment(config('wechat.payment.default'));

        // Example:
        $res = $app->refund->byOutTradeNumber($orderSn, $refundSn,$totalFee, $refundFee,  [
            // 可在此处传入其他参数，详细参数见微信支付文档
            'refund_desc' => $remark,
        ]);
        Log::info('退款接口返回:',$res);

        if($res['return_code'] == 'SUCCESS' && $res['return_msg'] == 'OK'){
            $refund = Refund::where('out_refund_no',$res['out_refund_no'])->first();
            $refund->update([
                'transaction_id' => $res['transaction_id'],
                'total_fee' => $res['total_fee'],
                'refund_fee' => $res['refund_fee'],
                'refund_id' => $res['refund_id'],
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

            return $res;
        }else{
            return false;
        }

    }*/


/*    public function pocketMoney($tradeNo,$openid,$amount){

        $app = Factory::payment(config('wechat.payment.default'));

        $res = $app->transfer->toBalance([
            'partner_trade_no' => $tradeNo, // 商户订单号，需保持唯一性(只能是字母或者数字，不能包含有符号)
            'openid' => $openid,
            'check_name' => 'NO_CHECK', // NO_CHECK：不校验真实姓名, FORCE_CHECK：强校验真实姓名
            're_user_name' => '', // 如果 check_name 设置为FORCE_CHECK，则必填用户真实姓名
            'amount' => $amount*100, // 企业付款金额，单位为分
            'desc' => '提现', // 企业付款操作说明信息。必填
        ]);

        Log::info('零钱接口返回:',$res);

        if($res['return_code'] == 'SUCCESS' && $res['result_code'] == 'SUCCESS'){
            return $res;
        }else{
            return false;
        }

    }*/

    /**
     * 小程序码
     * @param $url
     * @param $order_id
     * @return bool|string
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidArgumentException
     */
    /*public function appCode($url,$order_id){
        $app = Factory::miniProgram(config('wechat.mini_program.default'));

        $response = $app->app_code->getUnlimit('order_id='.$order_id,['page'=>$url]);

        if ($response instanceof \EasyWeChat\Kernel\Http\StreamResponse) {

            $path = storage_path('/app/appcode');
            $filename = $order_id.'.png';
            $response->saveAs($path, $filename);

            $appCode = asset('storage/appcode/'.$filename);

            CutOrder::where(['id'=>$order_id])->update(['app_code'=>$appCode]);

            return $appCode;
        }else{
            Log::info('小程序码错误：'.$response);
            return false;
        }
    }*/


/*    public function cutSendMessage($user_id,$url,$template_id,$msg){
        $user = User::find($user_id);

        if(!isset($user->cutFormId->form_id)) return false;

        $app = Factory::miniProgram(config('wechat.mini_program.default'));
        $res = $app->template_message->send([
            'touser' => $user->open_id,
            'template_id' => $template_id,
            'page' => $url,
            'form_id' => $user->cutFormId->form_id,
            'data' => $msg,
        ]);

        return $res;

    }*/

    //获取用户信息
    /*public function getUserMobile(Request $request){
        $app = Factory::miniProgram(config('wechat.mini_program.default'));
        $result = $app->encryptor->decryptData($request->session_key, $request->iv, $request->encryptData);
        //更新用户信息
        $userId = $request->userId;
        User::where(['id'=>$userId])->update(['mobile'=>$result['phoneNumber']]);

        return ['code'=>1,'data' =>$result ];
    }*/


}
