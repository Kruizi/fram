@extends('app')

@section('content')
    <div class="container">
        <a>Здорово</a>
        @foreach($good as $ur)
        {{$ur->desc}}
        @endforeach
    </div>
@endsection
