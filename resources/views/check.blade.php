@extends('app')

@section('content')
    <script>
        $('#loading-example-btn').click(function () {
            var btn = $(this)
            btn.button('loading')
            $.ajax({
                url: "more", // url запроса
                cache: false,
                data: { ids: ids }, // если нужно передать какие-то данные
                type: "POST", // устанавливаем типа запроса POST
                beforeSend: function(request) {  // нужно для защиты от CSRF
                    return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                },
                success: function(html) { $('#status').append(html);} //контент подгружается в div#content
            }).always(function () {
                btn.button('reset')
            });
            return false
        });
    </script>
    <div class="container">
        <button type="button" id="loading-example-btn" data-loading-text="Loading..." class="btn btn-primary noradius" style="margin:0px auto">Проверить статус</button>
        <ul>
        @foreach($good as $ur)
            <li>{{$ur->desc}} <br><span id="status" style="color:darkred;font-weight: bold;">Статус: {{$ur->name}}</span></li>
        @endforeach
        </ul>
    </div>
@endsection
