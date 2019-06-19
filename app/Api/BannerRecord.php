<?php
/**
 * Created by PhpStorm.
 * User: HaloBear
 * Date: 2018/6/12
 * Time: 17:57
 */

namespace App\Api;

use Illuminate\Database\Eloquent\Model;

class BannerRecord extends Model
{
    public function banner(){
        return $this->belongsTo(Banner::class,'banner_id');
    }

    public function getCoverAttribute($value)
    {
        return asset($value);
    }
}