<?php

namespace App\Api;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nick_name',
        'mobile',
        'last_time',
        'avatar_url',
        'open_id',
        'city',
        'province',
        'country',
        'gender',
        'language',
        'last_ip',
        'api_token'
    ];
}
