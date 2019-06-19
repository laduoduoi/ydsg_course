<?php

namespace App\Http\Controllers\Api;

use App\Api\Banner;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index()
    {
        $banner_list = [];
        $bannerList = Banner::query()->where('type', 'index')->with('record:id,banner_id,title,cover')->select('id',
            'title')->first();
        $bannerList && $banner_list = $bannerList['record'];

        return success(['banner_list' => $banner_list]);
    }
}
