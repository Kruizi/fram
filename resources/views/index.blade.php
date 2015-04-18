@extends('app')

@section('content')

<div class="container">
    <h1>Всего: <b id="count">{{$countDesc}}</b> уникальных ссылок </h1>
    <button type="button" id="loading-url-btn"  data-loading-text="Loading..." class="btn btn-primary btn-lg"
            onclick="url('http://web-sellers.ru/')" style="width: 100%;margin: 10px;">Проверить сайт на ссылки</button>
    <ul id="status">
        @foreach($good as $go)
           <li>{{$go->desc}}</li>
        @endforeach
        <a href="/check-url">Просмотреть и проверить ссылки на состояние </a>
    </ul>
</div>
@endsection
