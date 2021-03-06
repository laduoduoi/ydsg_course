<?php

namespace App\Http\Controllers\Admin;

use App\Admin\CoursePeriod;
use App\Admin\CoursePeriodQuestion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CoursePeriodQuestionController extends Controller
{
    //课时-问题列表
    public function list($id)
    {
        $list = CoursePeriodQuestion::query()->where('period_id', $id)->get();
        $course_id = CoursePeriod::find($id)->course_id;

        return view('Admin.Question.list', compact('list', 'id', 'course_id'));
    }

    //添加
    public function add($id)
    {

        return view('Admin.Question.add', compact('id'));
    }

    //保存
    public function save(Request $request)
    {
        $param = $this->check($request);
        if ($request->hasFile('cover') && $request->file('cover')->isValid()) {
            $storage_path = $request->file('cover')->store('public/course/period/cover');
            $path = str_replace('public/course/period/cover/', '', $storage_path);
            $param['cover'] = 'storage/course/period/cover/' . $path;
        }
        if ($request->hasFile('audio') && $request->file('audio')->isValid()) {
            $storage_path = $request->file('audio')->store('public/course/period/audio');
            $path = str_replace('public/course/period/audio/', '', $storage_path);
            $param['audio'] = 'storage/course/period/audio/' . $path;
        }
        CoursePeriodQuestion::create($param);
        $id = $param['period_id'];

        return redirect()->route('admin.question.list', compact('id'));
    }

    //编辑页
    public function edit($id)
    {

        $info = CoursePeriodQuestion::find($id);

        return view('Admin.Question.edit', compact('info'));
    }

    //更新
    public function update(Request $request, $id)
    {
        $param = $this->check($request);
        if ($request->hasFile('cover_edit') && $request->file('cover_edit')->isValid()) {
            $storage_path = $request->file('cover_edit')->store('public/course/period/cover');
            $path = str_replace('public/course/period/cover/', '', $storage_path);
            $param['cover'] = 'storage/course/period/cover/' . $path;
        }
        if ($request->hasFile('audio_edit') && $request->file('audio_edit')->isValid()) {
            $storage_path = $request->file('audio_edit')->store('public/course/period/audio');
            $path = str_replace('public/course/period/audio/', '', $storage_path);
            $param['audio'] = 'storage/course/period/audio/' . $path;
        }
        $result = CoursePeriodQuestion::query()->where('id', $id)->update($param);
        abort_if($result === false, 400, '更新失败');
        $id = $param['period_id'];
        return redirect()->route('admin.question.list', compact('id'));
    }

    //删除
    public function destroy($id)
    {
        $course_id = CoursePeriodQuestion::find($id)->course_id;
        CoursePeriodQuestion::query()->where('id', $id)->delete();

        return redirect()->route('admin.question.list', $course_id);
    }


    private function check($request)
    {
        $this->validate($request, [
            'title' => 'required',
            'audio' => 'required',
            'period_id' => 'required',
            'type' => 'required'
        ], [
            'title.required' => '请填写课时标题',
            'audio.required' => '请传入总结视频',
            'period_id.required' => '课时ID不正确',
            'type.required' => '问题类型未选择'
        ]);
        $param = $this->getReqParams(['title', 'cover', 'audio', 'period_id', 'sort', 'type']);
        return $param;
    }

}
