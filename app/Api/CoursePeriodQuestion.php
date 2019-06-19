<?php

namespace App\Api;

use Illuminate\Database\Eloquent\Model;

class CoursePeriodQuestion extends Model
{
    public function answer(){
        return $this->hasMany(CoursePeriodQuestionAnswer::class,'question_id')->orderBy('sort');
    }

    public function getAudioAttribute($value)
    {
        return asset($value);
    }
}