@extends('Admin.Layout.main')
@section('content')
<div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>问题管理</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="x_panel">
                        <div class="x_content">
                            <h4>
                                <a href="{{ route('admin.question.add',$id) }}" class="btn btn-info btn-xs">新增问题</a>
                                <a href="{{ route('admin.period.list',$course_id) }}" class="btn btn-info btn-xs">返回课时列表</a>
                            </h4>
                            <!-- start project list -->
                            <table class="table table-striped projects">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>标题</th>
                                    <th>封面图</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($list as $list)
                                    <tr>
                                        <td>{{$list->id}}</td>
                                        <td>{{$list->title}}</td>
                                        <td><img class="am-img-thumbnail am-img-bdrs" src="{{asset($list->cover)}}" alt="{{$list->title}}" height="100px"/></td>
                                        <td>
                                            <a href="{{ route('admin.answer.list',$list->id) }}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> 答案管理 </a>
                                            <a href="{{ route('admin.question.edit',$list->id) }}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> 编辑 </a>
                                            <a href="{{ route('admin.question.destroy',$list->id) }}" class="btn btn-danger btn-xs" onclick="return confirm('确定删除该问题？');"><i class="fa fa-trash-o"></i> 删除 </a>
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
