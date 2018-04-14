<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/font-awesome.css')}}">
    <link rel="stylesheet" href="{{asset('css/jquery.Jcrop.css')}}">
    <script type="text/javascript" src="{{asset('jquery/jquery-2.1.4.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('jquery/jquery.form.js')}}"></script>
    <script type="text/javascript" src="{{asset('jquery/jquery.Jcrop.min.js')}}"></script>
</head>
<body>
<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">Labula App</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="/">首页</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                @if(\Illuminate\Support\Facades\Auth::check())
                    <li><a id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="" href="">{{Auth::user()->name}}</a>
                        <ul class="dropdown-menu" aria-labelledby="dLabel">
                            <li><a href="/user/avatar"><i class="fa fa-user">更换头像</i></a></li>
                            <li><a href="/user/password"><i class="fa fa-cog">更换密码</i></a></li>
                            <li><a href=""><i class="fa fa-heart">  特别感谢</i></a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="/user/logout"><i class="fa fa-sign-out">  退出登录</i></a></li>
                        </ul>
                    </li>
                    <li><img src="{{Auth::user()->avatar}}" id="firstAvatar" class="img-circle" width="50" height="50" alt=""></li>
                @else
                <li><a href="{{url('/user/login')}}">登录</a></li>
                <li><a href="{{url('user/register')}}">注册</a></li>
                    @endif
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>
@yield('content')
<script src="{{asset('js/bootstrap.js')}}"></script>
</body>
</html>