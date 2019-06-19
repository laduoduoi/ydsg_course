<?php

namespace App\Api;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    public function record(){
        return $this->hasMany(CoursePeriod::class,'course_id')->orderBy('sort');
    }
}