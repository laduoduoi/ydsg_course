<?php
/**
 * Created by PhpStorm.
 * User: HaloBear
 * Date: 2018/6/12
 * Time: 17:57
 */

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;
use Silber\Bouncer\Database\HasRolesAndAbilities;

/**
 * App\Admin\Admin
 *
 * @mixin \Eloquent
 * @property int $id
 * @property string $username
 * @property string $password
 * @property int $status
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $login_ip
 * @property int $last_time
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin\Admin whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin\Admin whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin\Admin whereLastTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin\Admin whereLoginIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin\Admin wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin\Admin whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin\Admin whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin\Admin whereUsername($value)
 */
class Admin extends Model
{
    protected $fillable = [
        'user_name',
        'user_password',
    ];

    protected $hidden = ['user_password'];
}