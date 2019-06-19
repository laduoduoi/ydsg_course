@extends('Admin.Layout.main')
@section('content')
<div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>答案管理</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="x_panel">
                        <div class="x_content">
                            <h4>
                                <a href="{{ route('admin.answer.add',$id) }}" class="btn btn-info btn-xs">新增答案</a>
                                <a href="{{ route('admin.question.list',$period_id) }}" class="btn btn-info btn-xs">返回问题列表</a>
                            </h4>
                            <!-- start project list -->
                            <table class="table table-striped projects">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>答案选项</th>
                                    <th>排序</th>
                                    <th>类型</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($list as $list)
                                    <tr>
                                        <td>{{$list->id}}</td>
                                        <td>{{$list->title}}</td>
                                        <td>{{$list->sort}}</td>
                                        <td>{{$list->status_title}}</td>
                                        <td>
                                            <a href="{{ route('admin.answer.edit',$list->id) }}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> 编辑 </a>
                                            <a href="{{ route('admin.answer.destroy',$list->id) }}" class="btn btn-danger btn-xs" onclick="return confirm('确定删除该答案？');"><i class="fa fa-trash-o"></i> 删除 </a>
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
