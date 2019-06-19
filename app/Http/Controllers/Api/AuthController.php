<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\LoginService;
class AuthController extends Controller
{
    /**
     * 获取session key
     *
     * @param LoginService $service
     * @return \Illuminate\Http\Response
     */
    public function miniappSession(LoginService $service)
    {
        // 数据校验
        $this->validation([
            'code' => 'required',
        ]);

        $return = $service->code2Session($this->request->get('code'));

        return success($return);
    }

    /**
     * 微信小程序登录
     *
     * @param LoginService $service
     * @return $this
     */
    public function wechatLogin(LoginService $service)
    {
        // 数据校验
        $this->validation([
            'session_key'    => 'required',
            'encrypted_data' => 'required',
            'iv'             => 'required',
        ]);

        $session_key    = $this->request->get('session_key');
        $encrypted_data = $this->request->get('encrypted_data');
        $iv             = $this->request->get('iv');
        $openid         = $this->request->get('openid');

        return success($service->wechatLogin($session_key, $iv, $encrypted_data, $openid));
    }

    /**
     * 获取微信用户信息
     *
     * @param LoginService $service
     * @return \Illuminate\Http\Response
     */
    public function wechatUserInfo(LoginService $service)
    {
        // 数据校验
        $this->validation([
            'session_key'    => 'required',
            'encrypted_data' => 'required',
            'iv'             => 'required',
        ]);

        $session_key    = $this->request->get('session_key');
        $encrypted_data = $this->request->get('encrypted_data');
        $iv             = $this->request->get('iv');

        return success($service->wechatUserInfo($session_key, $iv, $encrypted_data));
    }
}
