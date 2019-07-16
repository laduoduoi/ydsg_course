<?php

namespace App\Http\Controllers\Api;

use App\Api\About;
use App\Api\CoursePeriodUser;
use App\Api\User;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function about()
    {
        $result = About::query()->select('id', 'title', 'content')->orderBy('sort')->get();
        $result->each(function ($item) {
            $item['open'] = false;
        });

        return success($result);
    }

    public function learned()
    {
        $user_id = $this->request->user()['id'];
        $result = CoursePeriodUser::query()->with('course:id,title')->withCount('record')->withCount('periodRecord')->where('user_id',
            $user_id)->groupBy('course_id')->get();
        //dda($result);
        $list = $result->map(function ($item) {
            $temp['title'] = $item['course']['title'];
            $temp['percent'] = round($item['record_count'] / $item['period_record_count'] * 100, 2);
            return $temp;
        });

        return success($list);
    }

    public function report()
    {
        $user_id = $this->request->user()['id'];
        $info = User::query()->where('id', $user_id)->select([
            'learning_day',
            'learn_course_num',
            'follow_up_num',
            'learn_time'
        ])->firstOrFail();
        return success($info);
    }

}
