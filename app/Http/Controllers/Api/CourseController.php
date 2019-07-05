<?php

namespace App\Http\Controllers\Api;

use App\Api\Course;
use App\Api\CoursePeriod;
use App\Api\CoursePeriodExchange;
use App\Api\CoursePeriodUser;
use App\Http\Controllers\Controller;

class CourseController extends Controller
{
    public function list()
    {
        $result = Course::query()->select('id', 'title', 'level')->orderBy('sort')->get();

        return success($result);
    }

    public function periodList()
    {
        $id = $this->request->get('id');
        $user_id = $this->request->user()['id'] ?? 1;
        empty($id) && $id = Course::query()->orderBy('sort')->first()->value('id');
        $result = Course::query()->where('id', $id)->with('record:id,course_id,title,sort,status')->select('id',
            'title', 'introduce')->first();

        $study_id = CoursePeriodUser::query()->where('user_id', $user_id)->where('course_id',
            $id)->pluck('period_id')->toArray();
        $exchange_id = CoursePeriodExchange::query()->where('user_id', $user_id)->where('course_id',
            $id)->where('exchange_status', 1)->first();
        $status = $exchange_id ? 1 : 0;

        $result['record']->each(function ($item) use ($study_id, $status) {
            $item['study_status'] = 0;
            if ($item['status'] == 0) {
                $item['status'] = $status;
            }
            if (in_array($item['id'], $study_id)) {
                $item['study_status'] = 1;
            }

        });

        return success($result);
    }

    public function periodReview()
    {
        $this->validation([
            'period_id' => 'required',
        ]);
        $id = $this->request->get('period_id');
        $result = CoursePeriod::query()->with([
            'record:id,period_id,title,sort,audio,type',
            'record.answer:id,title,question_id,status'
        ])->select('id',
            'title', 'video')->first($id);

        return success($result);
    }

    public function exchange()
    {
        $this->validation([
            'redeem_code' => 'required',
            'course_id' => 'required',
        ]);
        $user_id = $this->request->user()['id'] ?? 1;
        $redeem_code = $this->request->get('redeem_code');
        $id = $this->request->get('course_id');
        $result = CoursePeriodExchange::query()->where('course_id', $id)->where('user_id',
            $user_id)->where('redeem_code', $redeem_code)->first();
        abort_if($result['exchange_status'] == 1, 422, '该兑换码已被使用');
        abort_if(empty($result), 422, '兑换码错误或不存在');
        $result->exchange_status = 1;
        $result->save();
        return success();
    }

    public function courseReview()
    {
        $this->validation([
            'course_id' => 'required',
        ]);
        $id = $this->request->get('course_id');
        $result = Course::query()->select('id', 'title', 'introduce', 'video', 'purchase_note',
            'price')->firstOrFail($id);

        return success($result);
    }

    public function submitAnswers()
    {
        $this->validation([
            'course_id' => 'required',
        ]);
        $user_id = $this->request->user()['id'] ?? 1;
        $id = $this->request->get('course_id');
        CoursePeriodUser::updateOrCreate([
            'period_id' => $id,
            'user_id' => $user_id
        ], [
            'period_id' => $id,
            'user_id' => $user_id
        ]);

        return success();
    }

}
