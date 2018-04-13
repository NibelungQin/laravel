@extends('app')
@section('content')
<div class="container">
    <div class="col-md-6 col-md-offset-3">
        <form method="post" action="/user/register" accept-charset="UTF-8">
            {{csrf_field()}}
            <div class="form-group">
                <label for="name">用户名:</label>
                <input id="name" name="name" type="text" class="form-control">
            </div>
            <div class="form-group">
                <label for="email">邮箱:</label>
                <input id="email" name="email" class="form-control">
            </div>
            <div class="form-group">
                <label for="password">密码:</label>
                <input id="password" name="password" type="password" class="form-control">
            </div>
            <div class="form-group">
                <label for="password_confirmation">确认密码:</label>
                <input id="password_confirmation" name="password_confirmation" type="password" class="form-control">
            </div>
            <button type="submit" class="btn btn-success form-control">注册</button>
            {{--<img class="media-object img-circle" src="/public/images/default_avatar.jpg" alt="64x64" style="height: 64px ;width: 64px">--}}
        </form>
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
@endsection