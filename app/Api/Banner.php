<?php

namespace App\Api;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
  public function record(){
      return $this->hasMany(BannerRecord::class,'banner_id');
  }
}