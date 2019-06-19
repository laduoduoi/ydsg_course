<?php
/**
 * Created by PhpStorm.
 * User: HaloBear
 * Date: 2018/6/12
 * Time: 17:57
 */

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class BannerRecord extends Model
{
    protected $fillable = [
        'title',
        'cover',
        'sort',
        'banner_id'
    ];
    public function banner(){
        return $this->belongsTo(Banner::class,'banner_id');
    }
}