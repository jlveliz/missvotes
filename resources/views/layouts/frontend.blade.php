<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>{{config('app.name')}}</title>
	<link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/css/app.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('public/css/font-awesome.min.css') }}">
    @yield('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('public/css/frontend.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/css/animate.min.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
	 <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body @if(Request::path() == '/') class="body-black" @endif>
    {{-- @if (App::isLocale('es'))
        @include('frontend.partials.header-es-nav')
    @else
        @include('frontend.partials.header-en-nav')
    @endif --}}
    <div id="spinner">
        <div class="spinner" >
          <div class="rect1"></div>
          <div class="rect2"></div>
          <div class="rect3"></div>
          <div class="rect4"></div>
          <div class="rect5"></div>
        </div>
    </div>
	<header id="header">
        @include('frontend.partials.nav')
	</header><!-- /header -->
	<div class="container @if(Request::path() == '/') container-index @else container-app @endif">
        @yield('content')
		
        @if(Request::path() != '/')
        <footer class="row footer">
			<p class="text-center">{{date('Y')}}© {{ trans('app.credits') }}.</p>
		</footer>
        @endif
	</div>
    <script src="{{asset('public/js/app.js')}} "></script>
    <script src="{{asset('public/js/jquery-validation/dist/jquery.validate.min.js')}} "></script>
    @yield('js')
    <script src="{{asset('public/js/frontend-app.js')}} "></script>
    {{-- partials --}}
    @include('frontend.modals.login')
    @include('frontend.modals.register')
    @include('frontend.modals.activation')
    @include('frontend.modals.activation-success-message')
    @include('frontend.modals.register-success-message')
    @include('frontend.modals.email')
    @include('frontend.modals.email-change-password')

</body>
</html>