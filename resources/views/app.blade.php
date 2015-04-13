<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo csrf_token(); ?>">
	<title>Laravel</title>

	<link href="{{ asset('public/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('public/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/css/bootstrap-theme.min.css') }}" rel="stylesheet">
    <style>
        li{
            list-style-type: none;
        }
    </style>
	<!-- Fonts -->
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>


	@yield('content')

	<!-- Scripts -->
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
    <script>
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
                $('#loading-example-btn').attr('disabled', 'disabled');
                $('#loading-example-btn').text('База данных пуста');
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
            };
        }
    </script>
</body>
</html>
