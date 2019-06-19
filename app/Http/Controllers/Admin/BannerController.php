<?php

namespace App\Http\Controllers\Admin;

use App\Admin\BannerRecord;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin\Banner;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    //广告列表
    public function bannerList()
    {

        $banners = Banner::get();

        return view('Admin.Banner.bannerList', compact('banners'));
    }

    //广告添加
    public function bannerAdd()
    {

        return view('Admin.Banner.bannerAdd');
    }

    //广告保存
    public function bannerSave(Request $request)
    {
        $param = $this->check($request);
        Banner::create($param);

        return redirect()->route('admin.banner.list');
    }

    //广告编辑页
    public function bannerEdit($id)
    {

        $banner = Banner::find($id);

        return view('Admin.Banner.bannerEdit', compact('banner'));
    }

    //广告更新
    public function bannerUpdate(Request $request, $id)
    {
        $param = $this->check($request);
        $result = Banner::query()->where('id', $id)->update($param);
        abort_if($result === false, 400, '更新失败');

        return redirect()->route('admin.banner.list');
    }

    //删除
    public function bannerDel($id)
    {
        Banner::query()->where('id', $id)->delete();

        return redirect()->route('admin.banner.list');
    }


    private function check($request)
    {
        $this->validate($request, [
            'title' => 'required',
            'type' => 'required',
        ], [
            'title.required' => '请填写广告位',
            'type.required' => '请填写广告位标识',
        ]);
        $param = $this->getReqParams(['title', 'type']);
        return $param;
    }

    //广告列表
    public function bannerRecordList($id)
    {
        $banners = BannerRecord::query()->with('banner:id,title')->where('banner_id',$id)->get();

        return view('Admin.Banner.bannerRecordList', compact('banners', 'id'));
    }

    //广告添加
    public function bannerRecordAdd($id)
    {
        return view('Admin.Banner.bannerRecordAdd', compact('id'));
    }

    //广告保存
    public function bannerRecordSave(Request $request)
    {
        $param = $this->checkRecord($request);
        if ($request->hasFile('cover') && $request->file('cover')->isValid()) {
            $storage_path = $request->file('cover')->store('public/banner');
            $path = str_replace('public/banner/', '', $storage_path);
            $param['cover'] = 'storage/banner/' .$path ;
        }
        BannerRecord::create($param);
        return redirect()->route('admin.banner.record.list', $param['banner_id']);
    }

    //广告编辑页
    public function bannerRecordEdit($id)
    {

        $banner = BannerRecord::find($id);

        return view('Admin.Banner.bannerRecordEdit', compact('banner'));
    }

    //广告更新
    public function bannerRecordUpdate(Request $request, $id)
    {
        $param = $this->checkRecord($request);
        if ($request->hasFile('cover_edit') && $request->file('cover_edit')->isValid()) {
            $storage_path = $request->file('cover_edit')->store('public/banner');
            $path = str_replace('public/banner', '', $storage_path);
            $param['cover'] = 'storage/banner' .$path ;
        }
        BannerRecord::query()->where('id', $id)->update($param);

        return redirect()->route('admin.banner.record.list', $param['banner_id']);
    }

    //删除
    public function bannerRecordDel($id)
    {
        $banner = BannerRecord::find($id);
        if ($banner->cover) {
            $local = Storage::disk('local');
            $local->delete($banner->cover);
            /*dda($banner->cover);
            Storage::delete($banner->cover);*/
        }
        $banner->delete();

        return redirect()->route('admin.banner.record.list', $banner['banner_id']);
    }

    private function checkRecord($request)
    {
        $this->validate($request, [
            'title' => 'required',
            'cover' => 'required',
            'banner_id' => 'required'
        ], [
            'title.required' => '请填写广告标题',
            'cover.required' => '请上传广告图片',
            'cover.Dimensions' => '上传图片格式错误',
            'banner_id.required' => '缺少广告位ID'
        ]);
        $param = $this->getReqParams(['title', 'cover', 'sort', 'banner_id']);
        return $param;
    }

}
