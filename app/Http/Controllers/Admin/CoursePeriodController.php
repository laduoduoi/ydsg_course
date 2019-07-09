<?php

namespace App\Http\Controllers\Admin;

use App\Admin\CoursePeriod;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CoursePeriodController extends Controller
{
    //课时列表
    public function list($id)
    {

        $list = CoursePeriod::query()->where('course_id', $id)->get();

        return view('Admin.Period.list', compact('list', 'id'));
    }

    //添加
    public function add($id)
    {

        return view('Admin.Period.add', compact('id'));
    }

    //保存
    public function save(Request $request)
    {
        $param = $this->check($request);
        if ($request->hasFile('video') && $request->file('video')->isValid()) {
            $storage_path = $request->file('video')->store('public/course/period/video');
            $path = str_replace('public/course/period/video/', '', $storage_path);
            $param['video'] = 'storage/course/period/video/' . $path;
        }
        if ($request->hasFile('cover') && $request->file('cover')->isValid()) {
            $storage_path = $request->file('cover')->store('public/course/period/cover');
            $path = str_replace('public/course/period/cover/', '', $storage_path);
            $param['cover'] = 'storage/course/period/cover/' . $path;
        }
        if ($request->hasFile('audio') && $request->file('audio')->isValid()) {
            $storage_path = $request->file('audio')->store('public/course/period/video');
            $path = str_replace('public/course/period/video/', '', $storage_path);
            $param['audio'] = 'storage/course/period/video/' . $path;
        }
        CoursePeriod::create($param);
        $id = $param['course_id'];

        return redirect()->route('admin.period.list', compact('id'));
    }

    //编辑页
    public function edit($id)
    {

        $info = CoursePeriod::find($id);

        return view('Admin.Period.edit', compact('info'));
    }

    //更新
    public function update(Request $request, $id)
    {
        $param = $this->check($request);
        $info = CoursePeriod::find($id);
        if ($request->hasFile('video_edit') && $request->file('video_edit')->isValid()) {
            $storage_path = $request->file('video_edit')->store('public/course/period/video');
            $path = str_replace('public/course/period/video/', '', $storage_path);
            $param['video'] = 'storage/course/period/video/' . $path;
        }
        if ($request->hasFile('cover_edit') && $request->file('cover_edit')->isValid()) {
            $storage_path = $request->file('cover_edit')->store('public/course/period/cover');
            $path = str_replace('public/course/period/cover/', '', $storage_path);
            $param['cover'] = 'storage/course/period/cover/' . $path;
        }
        if ($request->hasFile('audio_edit') && $request->file('audio_edit')->isValid()) {
            $storage_path = $request->file('audio_edit')->store('public/course/period/video');
            $path = str_replace('public/course/period/video/', '', $storage_path);
            $param['audio'] = 'storage/course/period/video/' . $path;
        }
        $result = CoursePeriod::query()->where('id', $id)->update($param);
        abort_if($result === false, 400, '更新失败');

        return redirect()->route('admin.period.list',$info['course_id']);
    }

    //删除
    public function destroy($id)
    {
        $course_id = CoursePeriod::find($id)->course_id;
        CoursePeriod::query()->where('id', $id)->delete();

        return redirect()->route('admin.period.list', $course_id);
    }


    private function check($request)
    {
        $this->validate($request, [
            'title' => 'required',
            'cover' => 'required',
            'video' => 'required',
            'audio' => 'required',
            'course_id' => 'required'
        ], [
            'title.required' => '请填写课时标题',
            'cover.required' => '请传入封面图',
            'video.required' => '请传入视频文件',
            'audio.required' => '请传入音频文件',
            'course_id.required' => '课程ID不正确'
        ]);
        $param = $this->getReqParams(['title', 'cover', 'video', 'audio', 'lyric', 'course_id', 'status','sort']);
        return $param;
    }

}
