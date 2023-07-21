@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">兑换列表</div>
                <div class="panel-body">
                    <form action="/inbox/{{$dialogId}}/store" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <textarea name="content" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-success pull-right">发送私信</button>
                        </div>
                    </form>
                    <div class="message-list">
                        @foreach($messages as $message)
                        <div class="media">
                            <div class="media-left">
                                <a href="#">
                                    <img src="{{$message->fromUser->avatar}}">
                                </a>
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading">
                                    <a href="#">
                                        {{$message->fromUser->name}}
                                    </a>
                                </h4>
                                <p>
                                    {{$message->content}}
                                    <span class="pull-right">{{$message->created_at->format('Y-m-d H:i')}}</span>
                                </p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
