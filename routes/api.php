<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
// Route::group(['middleware' => ['auth.basic']],function () {
    // 课程-课时列表
    Route::get('/course/period', 'CourseController@periodList');
    // 课时详细
    Route::get('/course/period/{id}', 'CourseController@periodReview');
    // 提交答题结果
    Route::post('/course/period/{id}', 'CourseController@submitAnswers');

    //订单列表
    Route::any('/order/getlist', 'OrderController@getList');
    Route::any('/order/delete', 'OrderController@delOrder');

    //订单详情
    Route::any('/order/getdetail', 'OrderController@getDetail');

    //用户中心
    Route::any('/user/index', 'UserController@index');
    Route::any('/user/withdraw/info', 'UserController@withdrawInfo');
    Route::any('/user/withdraw/submit', 'UserController@withdrawSubmit');
    Route::any('/user/withdraw/detail', 'UserController@withdrawDetail');
    Route::any('/user/login/receive', 'UserController@loginReceive');


    //创建订单
    Route::any('/cut/order/create', 'CutOrderController@create');
    //订单详情
    Route::any('/cut/order/detail', 'CutOrderController@orderDetail');
    //支付
    Route::any('/cut/order/pay', 'CutOrderController@pay');
    Route::any('/cut/order/address', 'CutOrderController@cutAddress');

// });

Route::any('/', 'IndexController@index');

// 微信回调地址
Route::any('/miniapp/notice','WeChatController@notice');

// 小程序授权登录
// 获取sessionId
Route::any('/miniapp/session','AuthController@miniappSession');
// 登小程序录
Route::any('/miniapp/login','AuthController@wechatLogin');
// 获取微信用户数据
Route::any('/miniapp/user','AuthController@wechatUserInfo');




