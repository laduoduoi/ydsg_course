<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class CoursePeriodQuestion extends Model
{
    protected $fillable = [
        'title',
        'cover',
        'video',
        'audio',
        'period_id',
        'sort'
    ];
}