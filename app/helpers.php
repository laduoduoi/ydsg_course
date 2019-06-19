<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 2017/6/20
 * Time: 下午12:06.
 */

/**
 * 手机号校验.
 *
 * @param $phone
 *
 * @return int
 */
function is_mobile($phone)
{
    return preg_match("/^1[3456789]\d{9}$/", $phone);
}

/**
 * 阿里云短信
 *
 * @param        $phone
 * @param array $data
 * @param string $tpl
 * @param string $sign
 *
 * @return bool
 */
function ali_sms($phone, $data = [], $tpl = 'SMS_25480006', $sign = '幻熊科技')
{
    return \App\Extend\AliyunOpenApi::sendSms($phone, $data, $tpl, $sign);
}

/**
 * 获取图片地址
 * @param $src
 * @param string $folder
 *
 * @return string
 */
function get_image($src, $folder = '')
{
    return '/storage/app/' . $folder . '/'.$src;
}

function get_image_view($src, $width, $height, $quality = '75')
{
    return $src ? config('common.public_img_url') . $src . '?imageView2/2/w/' . $width . '/h/' . $height . '/interlace/1/q/' . $quality : '';
}

function dda($model)
{
    if (method_exists($model, 'toArray')) {
        dd($model->toArray());
    } else {
        dd($model);
    }
}

if (!function_exists('success')) {
    /**
     * @param array $data
     * @param string $info
     *
     * @return \Illuminate\Http\Response
     */
    function success($data = [], $info = '成功')
    {
        if (is_string($data) && $temp = json_decode($data, 1)) {
            $data = $temp;
        }

        empty($data) && $data = (object)[];

        return response([
            'iRet' => 1,
            'info' => $info,
            'data' => $data,
            'time' => sprintf('%.4f', microtime(true) - LARAVEL_START),
        ]);
    }
}


if (!function_exists('error')) {
    /**
     * 失败返回.
     *
     * @param array $data
     * @param string $info
     *
     * @return array
     */
    function error($info = '失败', $data = [])
    {
        return ['iRet' => 0, 'info' => $info, 'data' => $data];
    }
}

if (!function_exists('get_miniapp_application')) {
    /**
     * 获取小程序的应用
     *
     * @return string
     */
    function get_miniapp_application()
    {
        $application = str_replace('wedding-miniapp-', '', request()->header('X-Halo-App'));

        return config('wechat.mini_program.' . $application) ? $application : 'default';
    }
}

if (!function_exists('jwt_encode')) {
    /**
     * jwt加密
     *
     * @param array  $data
     * @param int    $exp
     * @param string $key
     * @return string
     */
    function jwt_encode($data = [], $exp = 86400, $key = '')
    {
        $key         = empty($key) ? env('JWT_SECRET') : $key;
        $data['exp'] = time() + $exp;

        return \Firebase\JWT\JWT::encode($data, $key);
    }
}

if (!function_exists('jwt_decode')) {
    /**
     * jwt解密
     *
     * @param        $token
     * @param string $key
     * @return array
     */
    function jwt_decode($token, $key = '')
    {
        $key = empty($key) ? env('JWT_SECRET') : $key;

        try {
            $data = \Firebase\JWT\JWT::decode($token, $key, ['HS256']);
        } catch (Exception $e) {
            $data = [];
        }

        return object_array($data);
    }
}

if (!function_exists('object_array')) {
    function object_array($d)
    {
        if (is_object($d)) {
            $d = get_object_vars($d);
        }

        if (is_array($d)) {
            return array_map(__FUNCTION__, $d);
        } else {
            return $d;
        }
    }
}

