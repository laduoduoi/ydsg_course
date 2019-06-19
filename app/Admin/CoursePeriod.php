<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class CoursePeriod extends Model
{
    protected $fillable = [
        'title',
        'cover',
        'video',
        'summary_video',
        'lyric',
        'course_id',
        'status',
        'sort'
    ];
    protected $appends = ['status_title'];

    public function getStatusTitleAttribute()
    {
        return $this->attributes['status'] ? '锁定' : '试用';
    }
}