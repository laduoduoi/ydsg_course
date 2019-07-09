<?php

namespace App\Http\Controllers\Api;

use App\Api\Course;
use App\Api\CoursePeriod;
use App\Api\CoursePeriodExchange;
use App\Api\CoursePeriodQuestion;
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
        $result = Course::query()->where('id', $id)->with('record:id,course_id,title,sort,status',
            'background:id,cover,course_id')->select('id',
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

    /**
     * 看一看
     *
     * @return \Illuminate\Http\Response
     */
    public function periodLook()
    {
        $this->validation([
            'period_id' => 'required',
        ]);
        $id = $this->request->get('period_id');
        $result = CoursePeriod::query()->select('id', 'title', 'video')->first($id);

        return success($result);
    }

    /**
     * 玩一玩
     *
     * @return \Illuminate\Http\Response
     */
    public function periodPlay()
    {
        $this->validation([
            'period_id' => 'required',
        ]);
        $id = $this->request->get('period_id');
        $list = CoursePeriodQuestion::query()->with([
            'answer:id,title,question_id,status,cover'
        ])->where('period_id', $id)->select('id', 'title', 'type', 'cover', 'audio')->orderBy('sort')->get();
        $temp = [];
        foreach ($list as $key => $value) {
            $temp[$key]['type'] = $value['type'];
            $temp[$key]['title'] = $value['title'];
            switch ($value['type']) {
                case 0:// 答题
                    $temp[$key]['cover'] = $value['cover'];
                    $temp[$key]['audio'] = $value['audio'];
                    $temp[$key]['answer'] = $this->formatList($value['answer'], 0);
                    break;
                case 1:// 跟读
                    $temp[$key]['audio'] = $value['audio'];
                    break;
                case 2:// 九宫格
                    $temp[$key]['cover'] = $value['cover'];
                    $temp[$key]['audio'] = $value['audio'];
                    $temp[$key]['answer'] = $this->formatList($value['answer'], 2);
                    break;
                default;
            }
        }

        return success($temp);
    }

    private function formatList($list, $type)
    {
        $temp = [];
        switch ($type) {
            case 0:
                foreach ($list as $key => $value) {
                    $temp[$key]['title'] = $value['title'];
                    $temp[$key]['status'] = $value['status'];
                }
                break;
            case 2:
                foreach ($list as $key => $value) {
                    $temp[$key]['cover'] = $value['cover'];
                    $temp[$key]['status'] = $value['status'];
                }
                break;
        }
        return $temp;
    }

    /**
     * 唱一唱
     *
     * @return \Illuminate\Http\Response
     */
    public function periodSing()
    {
        $this->validation([
            'period_id' => 'required',
        ]);
        $id = $this->request->get('period_id');
        $result = CoursePeriod::query()->select('id', 'title', 'audio')->first($id);

        return success($result);
    }

    /**
     * 兑换码
     *
     * @return \Illuminate\Http\Response
     */
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

    /**
     * 购买须知
     *
     * @return \Illuminate\Http\Response
     */
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

    /**
     * 提交学习进度
     *
     * @return \Illuminate\Http\Response
     */
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
