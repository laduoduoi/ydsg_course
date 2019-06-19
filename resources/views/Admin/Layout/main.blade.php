
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>悦读时光-课程后台管理系统 </title>

  <!-- Bootstrap -->
  <link href="{{asset('/amazeui/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="{{asset('/amazeui/vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
  <!-- NProgress -->
  <link href="{{asset('/amazeui/vendors/nprogress/nprogress.css')}}" rel="stylesheet">
  <!-- Custom Theme Style -->
  <link href="{{asset('/amazeui/build/css/custom.min.css')}}" rel="stylesheet">
  @yield('style')
</head>

<body class="nav-md">
<div class="container body">
  <div class="main_container">
    <!-- 栏目开始 -->
    @include('Admin.Layout.sidebar')
    <!-- 栏目结束 -->

    <!-- 头部开始 -->
  @include('Admin.Layout.header')
    <!-- 头部结束 -->

    <!-- page content -->
  @yield('content')
    <!-- /page content -->

    <!-- footer content -->
    <footer>
      <div class="pull-right">
        <a >悦读时光</a>
      </div>
      <div class="clearfix"></div>
    </footer>
    <!-- /footer content -->
  </div>
</div>

<!-- jQuery -->
<script src="{{asset('/amazeui/vendors/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap -->
<script src="{{asset('/amazeui/vendors/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('/amazeui/vendors/fastclick/lib/fastclick.js')}}"></script>
<!-- NProgress -->
<script src="{{asset('/amazeui/vendors/nprogress/nprogress.js')}}"></script>
<!-- bootstrap-progressbar -->
<script src="{{asset('/amazeui/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js')}}"></script>

<!-- Custom Theme Scripts -->
<script src="{{asset('/amazeui/build/js/custom.min.js')}}"></script>
@yield('javascript');
</body>
</html>