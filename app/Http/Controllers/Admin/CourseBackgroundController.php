<?php

namespace App\Http\Controllers\Admin;

use App\Admin\CourseBackground;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class CourseBackgroundController extends Controller
{
    //列表
    public function list($id)
    {
        $list = CourseBackground::query()->where('course_id',$id)->get();

        return view('Admin.Background.list', compact('list', 'id'));
    }

    //添加
    public function add($id)
    {
        return view('Admin.Background.add', compact('id'));
    }

    //保存
    public function save(Request $request)
    {
        $param = $this->checkRecord($request);
        if ($request->hasFile('cover') && $request->file('cover')->isValid()) {
            $storage_path = $request->file('cover')->store('public/background');
            $path = str_replace('public/background/', '', $storage_path);
            $param['cover'] = 'storage/background/' .$path ;
        }
        CourseBackground::create($param);
        return redirect()->route('admin.background.list', $param['course_id']);
    }

    //编辑页
    public function edit($id)
    {

        $info = CourseBackground::find($id);

        return view('Admin.Background.edit', compact('info'));
    }

    //更新
    public function update(Request $request, $id)
    {
        $param = $this->checkRecord($request);
        if ($request->hasFile('cover_edit') && $request->file('cover_edit')->isValid()) {
            $storage_path = $request->file('cover_edit')->store('public/background');
            $path = str_replace('public/background', '', $storage_path);
            $param['cover'] = 'storage/background' .$path ;
        }
        CourseBackground::query()->where('id', $id)->update($param);

        return redirect()->route('admin.background.list', $param['course_id']);
    }

    //删除
    public function destroy($id)
    {
        $info = CourseBackground::find($id);
        if ($info->cover) {
            $local = Storage::disk('local');
            $local->delete($info->cover);
            /*dda($banner->cover);
            Storage::delete($banner->cover);*/
        }
        $info->delete();

        return redirect()->route('admin.background.list', $info['course_id']);
    }

    private function checkRecord($request)
    {
        $this->validate($request, [
            'cover' => 'required',
            'course_id' => 'required'
        ], [
            'cover.required' => '请上传广告图片',
            'cover.Dimensions' => '上传图片格式错误',
            'course_id.required' => '缺少课程ID'
        ]);
        $param = $this->getReqParams(['cover', 'sort', 'course_id']);
        return $param;
    }

}
