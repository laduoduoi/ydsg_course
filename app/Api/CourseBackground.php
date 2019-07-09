<?php

namespace App\Api;

use Illuminate\Database\Eloquent\Model;

class CourseBackground extends Model
{
    public function getCoverAttribute($value)
    {
        return asset($value);
    }
}