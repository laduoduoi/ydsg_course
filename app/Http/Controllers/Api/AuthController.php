<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\LoginService;
//use Illuminate\Support\Facades\Redis;

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

        $session_id = md5($return['session_key'] . $return['openid']);
        $session = json_encode(['session_key' => $return['session_key'], 'openid' => $return['openid']]);

        //保存session_key 1年
        //Redis::setex('session_id:' . $session_id, 86400 * 365, $session);

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
            'session_key' => 'required',
            'encrypted_data' => 'required',
            'iv' => 'required',
        ]);

        $session_key = $this->request->get('session_key');
        $encrypted_data = $this->request->get('encrypted_data');
        $iv = $this->request->get('iv');

        return success($service->wechatLogin($session_key, $iv, $encrypted_data));
    }

    /**
     * 获取微信用户手机号
     *
     * @param LoginService $service
     * @return \Illuminate\Http\Response
     */
    public function getUserMobile(LoginService $service)
    {
        // 数据校验
        $this->validation([
            'session_key' => 'required',
            'encrypted_data' => 'required',
            'iv' => 'required',
        ]);

        $session_key = $this->request->get('session_key');
        $encrypted_data = $this->request->get('encrypted_data');
        $iv = $this->request->get('iv');

        return success($service->getUserMobile($session_key, $iv, $encrypted_data));
    }
}
