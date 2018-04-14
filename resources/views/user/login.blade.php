@extends('app')
@section('content')
<div class="container">
    <div class="col-md-6 col-md-offset-3">
        <br>
        <img id="images" class="media-object img-circle col-md-offset-5" src="/images/default_avatar.jpg" alt="64x64" style="height: 100px ;width: 100px;">
        <br>
        <form method="post" action="/user/login" accept-charset="UTF-8">
            {{csrf_field()}}
            <div class="form-group">
                <label for="email">邮箱:</label>
                <input id="email" name="email" class="form-control" onblur="showAvatar(this)">
            </div>
            <div class="form-group">
                <label for="password">密码:</label>
                <input id="password" name="password" type="password" class="form-control">
            </div>
            <button type="submit" class="btn btn-success form-control">登录</button>
            <a href="" class="pull-right" style="margin-top: 20px">忘记密码？</a>
        </form>
        @if(\Illuminate\Support\Facades\Session::has('user_login_failed'))
            <div class="alert alert-danger">
                {{\Illuminate\Support\Facades\Session::get('user_login_failed')}}
            </div>
            @endif
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</div>
<script>
    function showAvatar(obj) {
        var email=$(obj).val();
        $.post("{{url('user/showAvatar')}}",{'_token':'{{csrf_token()}}','_method':'get','email':email},function(data){
            $("#images").attr('src',data);
        })
    }
</script>
@endsection