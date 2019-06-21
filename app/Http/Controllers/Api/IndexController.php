<?php

namespace App\Http\Controllers\Api;

use App\Api\Banner;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index()
    {
        $list = Banner::query()->whereIn('type',
            ['index', 'index_activity'])->with('record:id,banner_id,title,cover')->select('id',
            'title', 'type')->get()->groupBy('type');

        return success(['banner_list' => $list['index'][0]['record'], 'activity_list' => $list['index_activity'][0]['record']]);
    }
}
