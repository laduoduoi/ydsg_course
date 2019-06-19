<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>后台管理系统 </title>

    <!-- Bootstrap -->
    <link href="{{asset('/amazeui/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{asset('/amazeui/css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{asset('/amazeui/css/nprogress.css')}}" rel="stylesheet">
    <!-- Animate.css -->
    <link href="{{asset('/amazeui/css/animate.min.css')}}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{asset('/amazeui/css/custom.min.css')}}" rel="stylesheet">

    <link rel="stylesheet" type="text/css" charset="utf-8" href="{{asset('amazeui/css/error.css')}}">
    <script type="text/javascript" src="{{asset('amazeui/css//vendor.min.js')}}"></script>

</head>

<body class="login msr">


<div class="error-wrap">
    <div class="action">

        <a class="hiddenanchor" id="signup"></a>
        <a class="hiddenanchor" id="signin"></a>

        <div class="login_wrapper">
            <div class="animate form login_form">
                <section class="login_content">
                    <form method="post" class="am-form" action="{{route('admin.login.act') }}">
                        <h1>登录</h1>
                        <div>
                            <input type="text" name="user_name" id="username"  class="form-control" placeholder="Username" required="" />
                        </div>
                        <div>
                            <input type="password"  name="password" id="password" class="form-control" placeholder="Password" required="" />
                        </div>
                        <div>
                            <input type="button" id="login" name="" value="登 录" class="btn btn-default submit button button1" >
                        </div>

                        <div class="clearfix"></div>

                        <div class="separator">
                            <div class="clearfix"></div>
                            <br />

                            <div>
                                <p> VANFUN健康官网 - 专注大健康，始终繁华</p>
                            </div>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
</div>

<div class="overlay"></div>
<div>
</div>
<script src="{{asset('/js/jquery.min.js')}}"></script>
<script src="{{asset('/js/jquery.form.min.js')}}"></script>
<script>
    $(function(){
        $('#login').on('click',function(){
            $('form').ajaxSubmit({
                success:function(data){
                    if(data.status){
                        window.location.href = data.url;
                    }else{
                        alert(data.info);
                    }
                }
            });
        });
    })
</script>
</body>
</html>