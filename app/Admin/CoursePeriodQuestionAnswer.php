<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class CoursePeriodQuestionAnswer extends Model
{
    protected $fillable = [
        'title',
        'question_id',
        'status',
        'sort',
        'cover'
    ];
    protected $appends = ['status_title'];

    public function getStatusTitleAttribute()
    {
        return $this->attributes['status'] ? '正确答案' : '错误答案';
    }
}