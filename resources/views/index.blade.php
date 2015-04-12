@extends('app')

@section('content')
<div class="container">
    @foreach($good as $go)
        {{$go->desc}}
    @endforeach
    <a href="/check-url">Просмотреть и проверить ссылки на состояние </a>
</div>
@endsection
