@extends('app')
@section('content')
@include('editor::head')
<div class="container">
    <div class="row">
        <div class="col-md-9 col-md-offset-1" role="main">
            <form action="{{url('/discussions')}}" method="POST" accept-charset="UTF-8">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="title">Title:</label>
                    <input id="title" name="title" class="form-control">
                </div>
                <div class="form-group">
                    <div class="editor">
                        <textarea name="body" id="myEditor" cols="30" rows="10" class="form-control"></textarea>
                    </div>
                </div>
                <button class="btn btn-primary pull-right">发表帖子</button>
            </form>
            <br><br><br>
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
</div>
    @endsection