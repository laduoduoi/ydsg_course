<?php
/**
 * Created by PhpStorm.
 * User: HaloBear
 * Date: 2018/6/12
 * Time: 17:57
 */

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    protected $fillable = [
        'title',
        'sort',
        'content'
    ];
}