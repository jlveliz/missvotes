<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>{{config('app.name')}}</title>
	<link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="{{ asset('public/css/app.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/css/frontend.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('public/css/animate.min.css') }}">
</head>
<body>
	<div class="container">
		{{Session::get('tipo_mensaje')}}
		{{Session::get('mensaje')}}
	</div>
</body>
</html>