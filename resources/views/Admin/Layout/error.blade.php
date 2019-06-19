@if (count($errors) > 0)
<div class="am-alert am-alert-danger" data-am-alert>
    <button type="button" class="am-close">&times;</button>
    <p class="am-text-center">错误提示</p>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif