<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>@yield('title') | Misses</title>
	<link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="{{ asset('public/css/app.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('public/css/frontend.css') }}">
	 <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
	<header id="header">
		<p class="text-center"><a class="text-center" href="#">Logo</a></p>
		@include('frontend.partials.nav')
	</header><!-- /header -->
	<script src="{{asset('public/js/app.js')}} "></script>
</body>
</html>