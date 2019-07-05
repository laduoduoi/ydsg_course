<?php

namespace App\Http\Controllers\Api;

use App\Api\About;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function about()
    {
        $result = About::query()->select('id', 'title','content')->orderBy('sort')->get();

        return success($result);
    }

}
