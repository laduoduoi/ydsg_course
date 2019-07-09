<?php

namespace App\Api;

use Illuminate\Database\Eloquent\Model;

class CoursePeriod extends Model
{
    public function record()
    {
        return $this->hasMany(CoursePeriodQuestion::class, 'period_id')->orderBy('sort');
    }

    public function getVideoAttribute($value)
    {
        return asset($value);
    }
    public function getAudioAttribute($value)
    {
        return asset($value);
    }
}