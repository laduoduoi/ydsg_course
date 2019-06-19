@extends('Admin.Layout.main')
@section('content')
<div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>广告管理</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="x_panel">
                        <div class="x_content">
                            <h4>
                                <a href="{{ route('admin.banner.record.add',$id) }}" class="btn btn-info btn-xs">新增广告</a>
                                <a href="{{ route('admin.banner.list') }}" class="btn btn-info btn-xs">返回广告列表</a>
                            </h4>
                            <!-- start project list -->
                            <table class="table table-striped projects">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>标题</th>
                                    <th>模块</th>
                                    <th>排序</th>
                                    <th>图片</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($banners as $list)
                                    <tr>
                                        <td>{{$list->id}}</td>
                                        <td>{{$list->title}}</td>
                                        <th>{{$list->banner->title}}</th>
                                        <td>{{$list->sort}}</td>
                                        <td><img class="am-img-thumbnail am-img-bdrs" src="{{asset($list->cover)}}" alt="{{$list->title}}" height="100px"/></td>
                                        <td>
                                            <a href="{{ route('admin.banner.record.edit',$list->id) }}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> 编辑 </a>
                                            <a href="{{ route('admin.banner.record.del',$list->id) }}" class="btn btn-danger btn-xs" onclick="return confirm('确定删除该广告？');"><i class="fa fa-trash-o"></i> 删除 </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <!-- end project list -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
