<?php

namespace App\Api;

use Illuminate\Database\Eloquent\Model;

class CoursePeriodQuestionAnswer extends Model
{
    public function getCoverAttribute($value)
    {
        return asset($value);
    }
}