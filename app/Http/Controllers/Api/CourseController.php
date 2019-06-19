<?php

namespace App\Http\Controllers\Api;

use App\Api\Course;
use App\Api\CoursePeriod;
use App\Api\CoursePeriodUser;
use App\Http\Controllers\Controller;

class CourseController extends Controller
{
    public function periodList()
    {
        $result = Course::query()->with('record:id,course_id,title,status,sort')->select('id',
            'title')->first();

        return success($result);
    }

    public function periodReview($id)
    {
        $result = CoursePeriod::query()->with([
            'record:id,period_id,title,sort,audio',
            'record.answer:id,title,question_id,status'
        ])->select('id',
            'title', 'video')->first($id);

        return success($result);
    }

    public function submitAnswers($id)
    {
        CoursePeriodUser::updateOrCreate([
            'period_id' => $id,
            'user_id' => 1
        ], [
            'period_id' => $id,
            'user_id' => 1
        ]);

        return success();
    }

}
