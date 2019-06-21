<?php

namespace App\Http\Controllers\Admin;

use App\Admin\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    /**
     * 管理员首页
     */
    public function list()
    {
        $list = Admin::get();

        return view('Admin.Admin.list', compact('list'));
    }

    //广告添加
    public function add()
    {

        return view('Admin.Admin.add');
    }

    /**
     * 后台管理员添加
     * @return \Illuminate\Http\JsonResponse
     */
    public function save()
    {
        $param = $this->getReqParams(['user_name', 'user_password']);
        $this->validation([
            'user_name' => 'required|unique:admins|max:10',
            'user_password' => 'required',
        ]);
        Admin::query()->create([
            'user_name' => $param['user_name'],
            'user_password' => password_hash($param['user_password'], PASSWORD_BCRYPT),
        ]);

        return redirect()->route('admin.admin.list');
    }

    //编辑
    public function edit($id)
    {

        $info = Admin::find($id);

        return view('Admin.Admin.edit', compact('info'));
    }

    /**
     * 更新管理员
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id)
    {
        $param = $this->getReqParams(['user_name', 'user_password']);
        $this->validation([
            'user_name' => [
                'required',
                Rule::unique('admins')->ignore($id),
                'max:10',
            ],
            'user_password' => 'required',
        ]);
        $user = Admin::query()->where('id', $id)->firstOrFail();
        $user->user_name = $param['user_name'];
        if (!empty($param['user_password'])) {
            $user->user_password = password_hash($param['user_password'], PASSWORD_BCRYPT);
        }
        $result = $user->save();
        abort_if(!$result, 400, '更新失败');

        return redirect()->route('admin.admin.list');
    }

    /**
     * 删除管理员
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        Admin::query()->where('id', $id)->delete();

        return redirect()->route('admin.admin.list');
    }
}