@extends('app')
@section('content')
<div class="jumbotron">
    <div class="container">
        <div class="media">
            <div class="media-left">
                <a href="#">
                    <img class="media-object img-circle" src="{{$discussion->user->avatar}}" alt="64x64" style="height: 64px ;width: 64px">
                </a>
            </div>
            <div class="media-body">
                <h4 class="media-heading">{{$discussion->title}}
                    @if(\Auth::check()&&\Auth::user()->id == $discussion->user_id)
                    <a class="btn btn-lg btn-danger btn-lg pull-right" href="{{url('/discussions/'.$discussion->id.'/edit')}}" role="button">修改帖子</a>
                    @endif
                </h4>
                {{$discussion->user->name}}
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-9" role="main">
            <div class="blog-post">
                {!! $html !!}
            </div>
            <hr>
            @foreach($discussion->comments as $comment)
            <div class="media">
                <div class="media-left">
                    <img class="media-object img-circle" src="{{$comment->user->avatar}}" alt="64x64" style="height: 64px ;width: 64px">
                </div>
                <div class="media-body">
                    <h4 class="media-heading">{{$comment->user->name}}</h4>
                    {{$comment->body}}
                </div>
            </div>
            @endforeach
            @if(Auth::check())
            <form action="/comment" method="POST" accept-charset="UTF-8">
                {{csrf_field()}}
                <input type="hidden" id="discussion_id" name="discussion_id" value="{{$discussion->id}}">
                <div class="form-group">
                    <textarea class="form-control" name="body" id="body" cols="30" rows="10"></textarea>
                </div>
                <div>
                    <button class="btn btn-success pull-right">发表评论</button>
                </div>
                <br><br><br>
            </form>
                @else
                <a class="btn btn-block btn-success" href="{{url('/user/login')}}">登录参与评论</a>
                @endif
        </div>
    </div>
</div>
@endsection
