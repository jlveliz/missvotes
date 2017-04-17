@extends('layouts.frontend')
@section('content')
	<div class="row">
		<h1 class="text-center">PROCESO DE APLICACIÓN</h1>
	</div>
	<div class="row">
		<div class="col-md-12 col-xs-12 col-lg-12">
			<!-- Nav tabs -->
			 <ul class="nav nav-tabs" role="tablist">
			   <li role="presentation" class="active"><a href="#countries" aria-controls="countries" role="tab" data-toggle="tab">País</a></li>
			   <li role="presentation" class="disabled"><a href="#pay" aria-controls="pay" role="tab" data-toggle="tab">Tasa de solicitud</a></li>
			   <li role="presentation" class="disabled"><a href="#aplication" aria-controls="aplication" role="tab" data-toggle="tab">Aplicación Online</a></li>
			   <li role="presentation" class="disabled"><a href="#status" aria-controls="status" role="tab" data-toggle="tab">Estado</a></li>
			 </ul>

			 <!-- Tab panes -->
			 <div class="tab-content">
			 	{{-- countries --}}
			   <div role="tabpanel" class="tab-pane active" id="countries">
			   		<p>Seleccione el país al que desea audicionar</p>
			   		<div class="row">
			   			<div class="col-md-12 col-lg-12">
			   				<ul>
			   					<li><img src=""></li>
			   				</ul>
			   			</div>
			   		</div>
			   </div>
			   {{-- pay --}}
			   <div role="tabpanel" class="tab-pane" id="pay">
			   		Hola paypal
			   </div>
			   {{-- aplication --}}
			   <div role="tabpanel" class="tab-pane" id="aplication">
			   		Hola aplicacion
			   </div>
			   {{-- hola status --}}
			   <div role="tabpanel" class="tab-pane" id="status">
			   		Hola status
			   </div>
			 </div>
		</div>
	</div>
@endsection


@section('js')
<script type="text/javascript">
    $('a[data-toggle="tab"]').on('click', function(){
        if ($(this).parent('li').hasClass('disabled')) {
            return false;
        }
    });
</script>
@endsection()
