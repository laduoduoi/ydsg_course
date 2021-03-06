@extends('Admin.Layout.main')
@section('content')
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>修改课时</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_content">
                            <form class="form-horizontal form-label-left"
                                  action="{{route('admin.period.update',$info->id)}}" enctype="multipart/form-data"
                                  method="post">
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="status">类型
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select name="status" id="status">
                                            <option value="0" @if($info['status'] == 0) selected @endif>锁定</option>
                                            <option value="1" @if($info['status'] == 1) selected @endif>试用</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">名称
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input class="form-control col-md-7 col-xs-12" name="title" id="title"
                                               value="{{$info->title}}" required="required" type="text">
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="sort">排序</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input class="form-control col-md-7 col-xs-12" name="sort" id="sort" value="{{$info->sort}}"
                                               required="required" type="text">
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cover">封面图
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <img id="imgHeadPhoto" class="am-img-responsive" src="{{asset($info->cover)}}" alt=""/>
                                        <input name="cover" type="hidden" value="{{$info->cover}}">
                                        <input name="cover_edit" type="file" onchange="PreviewImage(this,'imgHeadPhoto','divPreview');">
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="video">视频
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <a href="{{asset($info->video)}}" target="_blank">预览视频</a>
                                        <input name="video" type="hidden" value="{{$info->video}}">
                                        <input name="video_edit" type="file">
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="audio">音频
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <a href="{{asset($info->audio)}}" target="_blank">下载查看音频视频</a>
                                        <input name="audio" type="hidden" value="{{$info->audio}}">
                                        <input name="audio_edit" type="file">
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="lyric">歌词
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea id="lyric" name="lyric" style="width:700px;height:300px;">{{$info->lyric}}</textarea>
                                    </div>
                                </div>
                                <input name="course_id" value="{{$info->course_id}}" type="hidden">
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