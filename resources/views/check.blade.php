@extends('app')

@section('content')

    <div class="container">
        <button type="button" id="loading-example-btn" data-loading-text="Loading..." class="btn btn-primary btn-lg"
                onclick="check({{$countUrl}})" style="width: 100%;margin: 10px;">Проверить статус</button>
        <ul id="status">
            @foreach($good as $g)
                <li class="bg-success" style="margin: 10px; width: 100%;overflow: hidden;"><p  style="float: left; margin:0;">
                        Эта ссылка: {{$g->desc}}<p style="float: right;margin:0;" @if($g->name === 'HTTP/1.1 302 Found')class="bg-danger" @endif>{{$g->name}}</p></li>
            @endforeach
        </ul>
    </div>
@endsection
