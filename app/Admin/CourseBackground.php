<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class CourseBackground extends Model
{
    protected $fillable = [
        'cover',
        'course_id',
        'sort'
    ];
}