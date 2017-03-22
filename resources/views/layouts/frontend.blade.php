<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>{{config('app.name')}}</title>
	<link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="{{ asset('public/css/app.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('public/css/frontend.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
	 <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
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
	<div class="container container-app">
		<div class="jumbotron jumbotron-app hidden-xs">
			<h1>Reinas de belleza</h1>
			<p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Autem, quidem, quibusdam. Ducimus eligendi repudiandae natus error eveniet consectetur veniam in et, nobis hic, laudantium non nostrum deserunt atque praesentium temporibus!</p>
		</div>

		<div class="row">
			
            <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter hdpe">
                <img src="https://fakeimg.pl/300x300/" class="img-responsive">
            </div>

            <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter sprinkle">
                <img src="https://fakeimg.pl/300x300/" class="img-responsive">
            </div>

            <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter hdpe">
                <img src="https://fakeimg.pl/300x300/" class="img-responsive">
            </div>

            <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter irrigation">
                <img src="https://fakeimg.pl/300x300/" class="img-responsive">
            </div>

            <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter spray">
                <img src="https://fakeimg.pl/300x300/" class="img-responsive">
            </div>

            <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter irrigation">
                <img src="https://fakeimg.pl/300x300/" class="img-responsive">
            </div>

            <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter spray">
                <img src="https://fakeimg.pl/300x300/" class="img-responsive">
            </div>

            <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter irrigation">
                <img src="https://fakeimg.pl/300x300/" class="img-responsive">
            </div>

            <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter irrigation">
                <img src="https://fakeimg.pl/300x300/" class="img-responsive">
            </div>

            <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter hdpe">
                <img src="https://fakeimg.pl/300x300/" class="img-responsive">
            </div>

            <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter spray">
                <img src="https://fakeimg.pl/300x300/" class="img-responsive">
            </div>

            <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter sprinkle">
                <img src="https://fakeimg.pl/300x300/" class="img-responsive">
            </div>
		</div>
		<footer class="footer">
			<p class="text-center">{{date('Y')}}© todos los derechos reservados.</p>
		</footer>
	</div>
    <script src="{{asset('public/js/app.js')}} "></script>
	<script src="{{asset('public/js/frontend-app.js')}} "></script>
    {{-- partials --}}
    @include('frontend.modals.login')
    @include('frontend.modals.register')

</body>
</html>