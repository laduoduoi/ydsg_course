<?php

namespace App\Api;

use Illuminate\Database\Eloquent\Model;

class CoursePeriodExchange extends Model
{
    protected $fillable = [
        'period_id',
        'user_id'
    ];
}