<?php

namespace App\Api;

use Illuminate\Database\Eloquent\Model;

class CoursePeriodUser extends Model
{
    protected $fillable = [
        'period_id',
        'user_id'
    ];

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function record()
    {
        return $this->hasMany(CoursePeriodUser::class, 'course_id', 'course_id');
    }
    public function periodRecord()
    {
        return $this->hasMany(CoursePeriod::class, 'course_id');
    }
}