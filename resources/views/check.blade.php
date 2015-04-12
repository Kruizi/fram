@extends('app')

@section('content')

    <div class="container">
        <button type="button" id="loading-example-btn" data-loading-text="Loading..." class="btn btn-primary noradius" onclick="check({{$countUrl}})" style="margin:0px auto">Проверить статус</button>
        <ul id="status">
        </ul>
    </div>
@endsection
