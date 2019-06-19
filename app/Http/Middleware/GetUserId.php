<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Redis;
use App\Api\User;
use Illuminate\Http\Response;
class GetUserId
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(config('app.env') != 'test'){
            $sessionId = $request->header('SESSION-ID');

            $key = 'session_id:'.$sessionId;
            if(!Redis::exists($key)) return Response(['code'=>-1]);
            $session = Redis::get($key);

            $arr = json_decode($session,true);
            $openId = $arr['openid'];
            $user = User::where('open_id',$openId)->first();
            if(!$user) return Response(['code'=>-1]);
            $param = ['openid'=>$openId,'userId'=>$user->id];

        }else{
            $param = ['openid'=>'oVTXi5D7nXm6UpspdUu8ColXs95A','userId'=>1];
        }
        $request->merge($param);
        return $next($request);
    }
}
