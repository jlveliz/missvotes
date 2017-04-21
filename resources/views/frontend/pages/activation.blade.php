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
	<link rel="stylesheet" type="text/css" href=" {{asset('/public/css/font-awesome.min.css')}}">
	<style type="text/css">
		.alert-dismissible{
			margin-top: 20%;
		}
	</style>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-3 alert alert-dismissible @if($flagData['tipo_mensaje'] == 'success') alert-info  @endif @if($flagData['tipo_mensaje'] == 'error') alert-danger  @endif" role="alert" >
				<p class="text-center"><strong>{{$flagData['mensaje']}}</strong></p>
				<p class="text-center"><i class="fa fa-spinner fa-spin fa-1x fa-fw"></i>
				<span class="sr-only">Cargando...</span></p>
			</div>
		</div>
	</div>
	 <script src="{{asset('public/js/app.js')}} "></script>
	<script type="text/javascript">
		$(document).ready(function() {
			window.setTimeout(function() {
				window.location.href = 'http://www.misspanamint.com/login/';
			}, 3000);
		});
	</script>
</body>
</html>