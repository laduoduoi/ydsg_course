@extends('Admin.Layout.main')
@section('content')
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>修改答案</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_content">
                            <form class="form-horizontal form-label-left" action="{{route('admin.answer.update',$info->id)}}" enctype="multipart/form-data" method="post">
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">答案选项
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input class="form-control col-md-7 col-xs-12" name="title" id="title" value="{{$info->title}}" required="required" type="text">
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="sort">排序
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input class="form-control col-md-7 col-xs-12" name="sort" id="sort" value="{{$info->sort}}" required="required" type="text">
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="l_id">类型
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select name="status" id="status">
                                            <option value="0" @if($info['status'] == 0) selected @endif>错误答案</option>
                                            <option value="1" @if($info['status'] == 1) selected @endif>正确答案</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cover">九宫格图
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        @if(!empty($info->cover))<img  id="imgHeadPhoto" class="am-img-responsive" src="{{asset($info->cover)}}" alt=""/>@else<img  id="imgHeadPhoto" class="am-img-responsive" src="" alt=""/>@endif
                                        <input name="cover" type="hidden" value="{{$info->cover}}">
                                        <input name="cover_edit" type="file" onchange="PreviewImage(this,'imgHeadPhoto','divPreview');" >
                                    </div>
                                </div>
                                <input type="hidden" name="question_id" value="{{$info->question_id}}">
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <button id="send" type="submit" class="btn btn-success">确定</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascript')
    <script src="{{asset('/js/previewImage.js') }}"></script>
@endsection