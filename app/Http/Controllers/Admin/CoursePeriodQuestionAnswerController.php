<?php

namespace App\Http\Controllers\Admin;

use App\Admin\CoursePeriodQuestion;
use App\Admin\CoursePeriodQuestionAnswer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CoursePeriodQuestionAnswerController extends Controller
{
    // 课程-课时-问题-答案列表
    public function list($id)
    {

        $list = CoursePeriodQuestionAnswer::query()->where('question_id', $id)->get();
        $period_id = CoursePeriodQuestion::find($id)->period_id;
        return view('Admin.Answer.list', compact('list', 'id', 'period_id'));
    }

    // 添加
    public function add($id)
    {

        return view('Admin.Answer.add', compact('id'));
    }

    // 保存
    public function save(Request $request)
    {
        $param = $this->check($request);
        if ($request->hasFile('cover') && $request->file('cover')->isValid()) {
            $storage_path = $request->file('cover')->store('public/course/period/cover');
            $path = str_replace('public/course/period/cover/', '', $storage_path);
            $param['cover'] = 'storage/course/period/cover/' . $path;
        }
        CoursePeriodQuestionAnswer::create($param);

        return redirect()->route('admin.answer.list', $param['question_id']);
    }

    // 编辑页
    public function edit($id)
    {

        $info = CoursePeriodQuestionAnswer::find($id);

        return view('Admin.Answer.edit', compact('info'));
    }

    // 更新
    public function update(Request $request, $id)
    {
        $param = $this->check($request);
        if ($request->hasFile('cover_edit') && $request->file('cover_edit')->isValid()) {
            $storage_path = $request->file('cover_edit')->store('public/course/period/cover');
            $path = str_replace('public/course/period/cover/', '', $storage_path);
            $param['cover'] = 'storage/course/period/cover/' . $path;
        }
        $result = CoursePeriodQuestionAnswer::query()->where('id', $id)->update($param);
        abort_if($result === false, 400, '更新失败');

        return redirect()->route('admin.answer.list', $param['question_id']);
    }

    // 删除
    public function destroy($id)
    {
        $question_id = CoursePeriodQuestionAnswer::find($id)->question_id;
        CoursePeriodQuestionAnswer::query()->where('id', $id)->delete();

        return redirect()->route('admin.answer.list', $question_id);
    }


    private function check($request)
    {
        $this->validate($request, [
            'title' => 'required',
            'question_id' => 'required',
        ], [
            'title.required' => '请填写答案',
            'question_id.required' => '问题ID不正确',
        ]);
        $param = $this->getReqParams(['title', 'question_id', 'status', 'sort', 'cover']);
        return $param;
    }

}

