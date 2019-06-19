<?php

namespace App\Http\Controllers\Admin;

use App\Admin\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{
    //课程列表
    public function list()
    {

        $list = Course::get();

        return view('Admin.Course.list', compact('list'));
    }

    //添加
    public function add()
    {

        return view('Admin.Course.add');
    }

    //保存
    public function save(Request $request)
    {
        $param = $this->check($request);
        if ($request->hasFile('video') && $request->file('video')->isValid()) {
            $storage_path = $request->file('video')->store('public/course/video');
            $path = str_replace('public/course/video/', '', $storage_path);
            $param['video'] = 'storage/course/video/' . $path;
        }
        Course::create($param);

        return redirect()->route('admin.course.list');
    }

    //编辑页
    public function edit($id)
    {

        $info = Course::find($id);

        return view('Admin.Course.edit', compact('info'));
    }

    //更新
    public function update(Request $request, $id)
    {
        $param = $this->check($request);
        if ($request->hasFile('video_edit') && $request->file('video_edit')->isValid()) {
            //删除原来的图片
            $info = Course::find($id);
            if ($info->video) {
                $imagePath = str_replace('storage/course/video/', '', $info->video);
                Storage::delete($imagePath);
            }
            $storage_path = $request->file('video_edit')->store('public/course/video');
            $path = str_replace('public/course/video/', '', $storage_path);
            $param['video'] = 'storage/course/video/' . $path;
        }
        $result = Course::query()->where('id', $id)->update($param);
        abort_if($result === false, 400, '更新失败');

        return redirect()->route('admin.course.list');
    }

    //删除
    public function destroy($id)
    {
        Course::query()->where('id', $id)->delete();

        return redirect()->route('admin.course.list');
    }


    private function check($request)
    {
        $this->validate($request, [
            'title' => 'required',
            'introduce' => 'required',
            'video' => 'required',
            'purchase_note' => 'required',
            'price' => 'required',
        ], [
            'title.required' => '请填写课程标题',
            'introduce.required' => '请填写介绍',
            'video.required' => '请传入视频',
            'purchase_note.required' => '请填写购买须知',
            'price.required' => '请填写价格',
        ]);
        $param = $this->getReqParams(['title', 'introduce', 'video', 'purchase_note', 'price']);
        return $param;
    }

}
