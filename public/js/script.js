$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(document).ready(function () {
    $('#removeUrl').fadeOut();
});
function check($count){
    $('#status li').remove();
    if($count == '0')
    {
        $('#loading-example-btn').attr('disabled', 'disabled').text('База данных пуста');
        $('#removeUrl').fadeIn();
    }
    for (var i = 1; i < $count; i++) {
        $.ajax({
            url: "more", // url запроса
            cache: false,
            data: { i: i }, // если нужно передать какие-то данные
            type: "POST", // устанавливаем типа запроса POST
            beforeSend: function(request) {  // нужно для защиты от CSRF
                return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
            },
            success: function(data) {
                $('#status').append('<li class="bg-success" style="margin: 10px; width: 100%;overflow: hidden;">'+data+'</li>');
            } //контент подгружается в div#content
        }).always(function () {
            alert('Вывел все статусы')
        });
    }
}
function url(url){
    if(/^((https?|ftp)\:\/\/)?([a-z0-9]{1})((\.[a-z0-9-])|([a-z0-9-]))*\.([a-z]{2,6})(\/?)$/.test(url) == true){
        alert('Начинается парсинг этого '+url+' сайта');
        $('#status li').remove();
        for (var is = 1; is < 100; is++) {
            var i = 1;
            $.ajax({
                url: "check", // url запроса
                cache: false,
                data: {iss: 'iss'}, // если нужно передать какие-то данные
                type: "POST", // устанавливаем типа запроса POST
                beforeSend: function (request) {  // нужно для защиты от CSRF
                    return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                },
                success: function (data) {
                    $('#status').append('<li class="bg-success" style="margin: 10px; width: 100%;overflow: hidden;">' + data + '</li>');
                    $('#count').empty().text(i++);
                } //контент подгружается в div#content
            })
        }
    } else {
        alert('no');
    }
}