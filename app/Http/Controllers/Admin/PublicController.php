<?php

namespace App\Http\Controllers\Admin;

use App\Admin\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;

class PublicController extends Controller
{
    //登陆
    public function login()
    {

        return view('Admin.Public.login');
    }

    //登陆操作
    public function loginAct()
    {
        $user_name = $this->request->get('user_name');
        $user_password = $this->request->get('password');
        $this->validation([
            'user_name' => 'required',
            'password' => 'required',
        ]);

        $user = Admin::query()->where('user_name', $user_name)->first();
        if ((empty($user)|| !password_verify($user_password, $user['user_password']))) {
            $data = [
                'status' => 0,
                'info' => '用户名或密码错误！',
            ];
        } else {
            $data = [
                'status' => 1,
                'url' => route('admin.banner.list'),
            ];
            session(['admin_user_id' => 1]);
        }
        return response()->json($data);
    }

    //退出操作
    public function signOut()
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }

    /**
     * 修复redis丢失脚本
     * @param Request $request
     */
    public function bug1(Request $request)
    {
        $orderSn = $request->order_sn;

        $order = Order::where(['order_sn' => $orderSn])->first();

        if (!$order) {
            echo '找不到指定订单';
            exit;
        }

        $lottery = Lottery::where(['order_id' => $order->id])->first();

        $key = 'lottery:' . $lottery->id;

        if (Redis::exists($key)) {
            echo 'redis 已经存在不需要初始化';
            exit;
        }

        $peopleNum = $lottery->people_num - $lottery->join_num;

        //把订单总人数添加到REDIS，时效为172800秒
        Redis::setex($key, 86400 * 3, $peopleNum);

        $lotteryLogs = LotteryLog::where(['lottery_id' => $lottery->id])->get();

        foreach ($lotteryLogs as $lotteryLog) {
            Redis::sadd('lottery_user:' . $lottery->id, $lotteryLog->receipt_user_id);
        }

        echo '重新初始化成功！';
        exit;

    }
}
