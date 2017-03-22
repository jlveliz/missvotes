<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title> @yield('title') | {{config('app.name')}}</title>
	<link rel="stylesheet" type="text/css" href="{{ asset('public/css/app.css') }}">
	<link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="{{ asset('public/css/errors.css') }}">
</head>
<body>
	@yield('content')
</body>
</html>