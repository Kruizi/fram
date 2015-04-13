@extends('app')

@section('content')
<div class="container">
    <h1>Всего: {{$countDesc}} уникальных ссылок </h1>
    @foreach($good as $go)
        {{$go->desc}}<br>
    @endforeach
    <a href="/check-url">Просмотреть и проверить ссылки на состояние </a>
</div>
@endsection
