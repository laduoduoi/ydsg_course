@extends('Admin.Layout.main')
@section('content')
<div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>管理员管理</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="x_panel">
                        <div class="x_content">
                            <h4><a href="{{ route('admin.admin.add') }}" class="btn btn-info btn-xs">新增管理员</a></h4>
                            <!-- start project list -->
                            <table class="table table-striped projects">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>用户名</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($list as $list)
                                    <tr>
                                        <td>{{$list->id}}</td>
                                        <td>{{$list->user_name}}</td>
                                        <td>
                                            <a href="{{ route('admin.admin.edit',$list->id) }}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> 编辑 </a>
                                            <a href="{{ route('admin.admin.destroy',$list->id) }}" class="btn btn-danger btn-xs" onclick="return confirm('确定删除该管理员？');"><i class="fa fa-trash-o"></i> 删除 </a>
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
