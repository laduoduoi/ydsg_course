<?php

namespace App\Services;

use App\Api\User;
use EasyWeChat\Factory;

class LoginService
{
    /**
     * 小程序获取 session key
     *
     * @param $code
     * @return array
     */
    public function code2Session($code)
    {
        $app = Factory::miniProgram(config('wechat.mini_program.default'));

        $auth = $app->auth->session($code);
        abort_if(isset($auth['errcode']), 422, 'code 已失效');

        // 检查用户是否
        $user = $auth['openid'] ? User::where('open_id', $auth['openid'])->first() : [];
        if ($user) {
            // 记录状态
            $user->last_time      = time();
            $user->last_ip        = request()->ip();
            $user->save();

            $user_data = ['id' => $user['id'], 'nick_name' => $user['nick_name'], 'mobile' => $user['mobile'], 'avatar_url' => $user['avatar_url']];

            // 生成token
            $token = jwt_encode(['id' => $user['id'], 'nick_name' => $user['nick_name'], 'mobile' => $user['mobile']], 5184000, '9bd6c1ea65995ffe80ed39f0787c95ec');// key=ydsg_course md5

            $auth ['token'] = $token;
            $auth['user']   = $user_data;

        }

        return $auth;
    }

    /**
     * 微信小程序登录
     *
     * @param $session_key
     * @param $iv
     * @param $encryptData
     * @return array
     */
    public function wechatLogin($session_key, $iv, $encryptData)
    {
        $result = $this->decryptData($session_key, $iv, $encryptData);

        // 检查用户是否存在
        $user = User::where(['open_id' => $result['openId']])->select(['id', 'avatar_url', 'mobile', 'nick_name'])->first();

        if (empty($user)) {
            $data     = [
                'nick_name'  => base64_encode($result['nickName']),
                'mobile'     => $result['purePhoneNumber'],
                'last_time' => time(),
                'avatar_url'    => $result['avatarUrl'], // 未更换默认头像
                'open_id'=>$result['openId'],
                'city'=>$result['city'],
                'province'=>$result['province'],
                'country'=>$result['country'],
                'gender'=>$result['gender'],
                'language' => $result['language'],
            ];

            $user = User::create($data);
        }else{
            // 最近登录时间
            $user->last_time = time();
            $user->save();
        }

        $user_data = ['id' => $user['id'], 'nick_name' => $user['nick_name'], 'mobile' => $user['mobile'],  'avatar_url' => $user['avatar_url']];

        // 生成token
        $token = jwt_encode(['id' => $user['id'], 'nick_name' => $user['nick_name'], 'mobile' => $user['mobile']], 5184000, '9bd6c1ea65995ffe80ed39f0787c95ec');

        return ['token' => $token, 'user' => $user_data];
    }

    /**
     * 获取微信用户信息
     *
     * @param $session
     * @param $iv
     * @param $data
     * @return mixed
     */
    public function wechatUserInfo($session, $iv, $data)
    {
        return $this->decryptData($session, $iv, $data);
    }

    /**
     * 小程序数据解密
     *
     * @param $session
     * @param $iv
     * @param $data
     * @return mixed
     */
    private function decryptData($session, $iv, $data)
    {
        $app = Factory::miniProgram(config('wechat.mini_program.default'));

        return $decryptedData = $app->encryptor->decryptData($session, $iv, $data);
    }

}