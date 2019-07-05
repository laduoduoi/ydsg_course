<?php

namespace App\Http\Controllers\Admin;

use App\Admin\About;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AboutController extends Controller
{
    // 列表
    public function list()
    {
        $list = About::query()->get();
        return view('Admin.About.list', compact('list'));
    }

    // 添加
    public function add()
    {

        return view('Admin.About.add');
    }

    // 保存
    public function save(Request $request)
    {
        $param = $this->check($request);
        About::create($param);

        return redirect()->route('admin.about.list');
    }

    // 编辑页
    public function edit($id)
    {

        $info = About::find($id);

        return view('Admin.About.edit', compact('info'));
    }

    // 更新
    public function update(Request $request, $id)
    {
        $param = $this->check($request);
        $result = About::query()->where('id', $id)->update($param);
        abort_if($result === false, 400, '更新失败');

        return redirect()->route('admin.about.list');
    }

    // 删除
    public function destroy($id)
    {
        About::query()->where('id', $id)->delete();

        return redirect()->route('admin.about.list');
    }


    private function check($request)
    {
        $this->validate($request, [
            'title' => 'required',
        ], [
            'title.required' => '请填写标题',
        ]);
        $param = $this->getReqParams(['title', 'content', 'sort']);
        return $param;
    }

}
