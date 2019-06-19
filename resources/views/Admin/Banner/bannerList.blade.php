@extends('Admin.Layout.main')
@section('content')
<div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>广告位管理</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="x_panel">
                        <div class="x_content">
                            <h4><a href="{{ route('admin.banner.add') }}" class="btn btn-info btn-xs">新增类别</a></h4>
                            <!-- start project list -->
                            <table class="table table-striped projects">
                                <thead>
                                <tr>
                                    <th>名称</th>
                                    <th>标识</th>
                                    <th>排序</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($banners as $list)
                                    <tr>
                                        <td>{{$list->id}}</td>
                                        <td>{{$list->title}}</td>
                                        <td>{{$list->type}}</td>
                                        <td>
                                            <a href="{{ route('admin.banner.record.list',$list->id) }}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> 广告列表 </a>
                                            <a href="{{ route('admin.banner.edit',$list->id) }}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> 编辑 </a>
                                            <a href="{{ route('admin.banner.del',$list->id) }}" class="btn btn-danger btn-xs" onclick="return confirm('确定删除该广告位？');"><i class="fa fa-trash-o"></i> 删除 </a>
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
