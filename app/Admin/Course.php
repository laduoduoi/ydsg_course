<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'title',
        'introduce',
        'video',
        'purchase_note',
        'price'
    ];
}