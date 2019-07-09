<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class CoursePeriodQuestion extends Model
{
    protected $fillable = [
        'title',
        'cover',
        'audio',
        'period_id',
        'sort',
        'type'
    ];
    protected $appends = ['type_title'];

    public function getTypeTitleAttribute()
    {
        $type = [
            0  => '答题',
            1  => '跟读',
            2  => '九宫格',
        ];
        return isset($this->attributes['type']) ? $type[$this->attributes['type']] ?? '' : '';
    }
}