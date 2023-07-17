@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ $question->title }}
                    @foreach($question->topics as $topic)
                        <a class="topic" href="/topic/{{ $topic->id }}">{{ $topic->name }}</a>
                    @endforeach
                </div>
                <div class="panel-body content">
                    {!! $question->content !!}
                </div>
                <div class="actions">
                    @if(Auth::check() && Auth::user()->owns($question))
                    <a href="/questions/{{$question->id}}/edit">
                        <button class="btn btn-primary">编辑</button>
                    </a>
                    <form action="/questions/{{$question->id}}" method="POST" class="delete-form">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <button class="btn btn-danger">删除</button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading question-follow">
                    <h2>{{$question->followers_count}}</h2>
                    <span>关注者</span>
                </div>
                @if(Auth::check())
                <div class="panel-body">
            <!-- <a href="/question/{{$question->id}}/follow" class="btn btn-default {{ Auth::user()->followed($question->id) ? 'btn-success' : ''}}">
                        {{ Auth::user()->followed($question->id) ? '已关注' : '关注该问题'}}
                </a>-->
                    <question-follow-button question="{{$question->id}}"></question-follow-button>
                    <a href="#editor" class="btn btn-primary pull-right">撰写答案</a>
                </div>
                @endif
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading question-follow">
                    <h5>关于作者</h5>
                </div>
                <div class="panel-body">
                    <div class="media">
                        <div class="media-left">
                            <a href="#">
                                <img style="width: 36px" src="{{$question->user->avatar}}" alt="{{$question->user->name}}">
                            </a>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading">
                                <a href="#">{{$question->user->name}}</a>
                            </h4>
                        </div>
                        <div class="user-statics">
                            <div class="statics-item text-center">
                                <div class="statics-text">问题</div>
                                <div class="statics-count">{{$question->user->questions_count}}</div>
                            </div>
                            <div class="statics-item text-center">
                                <div class="statics-text">回答</div>
                                <div class="statics-count">{{$question->user->answers_count}}</div>
                            </div>
                            <div class="statics-item text-center">
                                <div class="statics-text">关注者</div>
                                <div class="statics-count">{{$question->user->followers_count}}</div>
                            </div>
                        </div>
                    </div>
                    @if(Auth::check())
                    <user-follow-button user="{{$question->user_id}}"></user-follow-button>
                    <a href="#editor" class="btn btn-default pull-right">发送私信</a>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-8 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ $question->answers_count }} 个答案
                </div>
                <div class="panel-body">
                    @foreach($question->answers as $answer)
                    <div class="media">
                        <div class="media-left">
                            <a href="">
                                <img width="48" src="{{$answer->user->avatar}}" alt="{{$answer->user->name}}">
                            </a>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading">
                                <a href="/user/{{$answer->user->name}}">
                                    {{$answer->user->name}}
                                </a>
                            </h4>
                            {!! $answer->content !!}
                        </div>
                    </div>
                    @endforeach
                    @if(Auth::check())
                    <form action="/questions/{{ $question->id }}/answer" method="post" id="editor">
                        {!! csrf_field() !!}
                        <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                            <script id="container" name="content" style="height: 200px;" type="text/plain">
                                {!! old('content') !!}
                            </script>
                            @if ($errors->has('content'))
                            <span class="help-block">
                                <strong>{{ $errors->first('content') }}</strong>
                            </span>
                            @endif
                        </div>
                        <button class="btn btn-success pull-right" type="submit">提交答案</button>
                    </form>
                    @else
                    <a href="/login" class="btn btn-success btn-block">登录提交答案</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
@include('vendor.ueditor.assets')
<script type="text/javascript">
    let ue = UE.getEditor('container');
    ue.ready(function() {
        ue.execCommand('serverparam', '_token', '{{ csrf_token() }}');
    });
</script>
@endsection


