<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        $this->app['auth']->viaRequest('api', function ($request) {
            // if (strpos(request()->path(), 'wed-console') === false) {
            // 应用检查
            $app_name = $request->header('X-Halo-App');
            $app      = config('common.app');

            // 检查应用信息
            abort_if(!isset($app[$app_name]), 400, 'application error');
            $user = get_user($request->bearerToken(), $app[$app_name]['jwt_secret']);

            // Log::info($user['phone']);

            if (empty($user)) {
                return abort(401, 'Unauthorized.');
            } else {
                return $user;
            }
            // }
        });
    }
}
