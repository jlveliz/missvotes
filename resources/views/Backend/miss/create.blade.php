@extends('layouts.backend')
@section('content')
<div class="panel panel-default">
	<div class="panel-heading">Candidatas</div>
	<p class="subtitle">Creación de Candidatas</p>
	<div class="panel-body">
		@if (Session::has('mensaje'))
        <div class="alert alert-dismissible @if(Session::get('tipo_mensaje') == 'success') alert-info  @endif @if(Session::get('tipo_mensaje') == 'error') alert-danger  @endif" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
          {{session('mensaje')}}
           </div>
        <div class="clearfix"></div>
       @endif
		<form action="{{ route('misses.store') }}" method="post" enctype="multipart/form-data" class="dropzone">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<div class="row">
				<div class="form-group col-md-3 col-sm-3 col-xs-12 @if($errors->has('name')) has-error @endif">
					<label class="control-label">Nombre </label>
					<input type="text" class="form-control" placeholder="Nombre" name="name" value="{{ old('name') }}" autofocus>
					@if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
				</div>

				<div class="form-group col-md-3 col-sm-3 col-xs-12 @if($errors->has('last_name')) has-error @endif">
					<label class="control-label">Apellido </label>
					<input type="text" class="form-control" placeholder="Apellido" name="last_name" value="{{ old('last_name') }}">
					@if ($errors->has('last_name')) <p class="help-block">{{ $errors->first('last_name') }}</p> @endif
				</div>

				<div class="form-group col-md-3 col-sm-3 col-xs-12 @if($errors->has('city_id')) has-error @endif">
					<label class="control-label">Ciudad </label>
					<select class="form-control" name="city_id" id="city">
						<option value="null">--Seleccione--</option>
						@foreach ($cities as $element)
							<option value="{{$element->id}}" @if(old('city_id') == $element->id) selected  @endif>{{$element->name}}</option>
						@endforeach
					</select>
					@if ($errors->has('city_id')) <p class="help-block">{{ $errors->first('city_id') }}</p> @endif
				</div>

				<div class="form-group col-md-2 col-sm-2 col-xs-12 @if($errors->has('state')) has-error @endif">
					<label class="control-label">Estado </label>
					<select name="state" id="state" class="form-control">
						<option value="null">--Seleccione--</option>
						<option value="1">Activa</option>
						<option value="0">Inactiva</option>
					</select>
					@if ($errors->has('state')) <p class="help-block">{{ $errors->first('state') }}</p> @endif
				</div>
			</div>


			<div class="row">
				<div class="form-group col-md-6 col-sm-6 col-xs-12">
					<label class="control-label col-md-12 col-sm-12 col-xs-12 no-padding">Medidas </label>
					<div class="form-group col-md-3 col-sm-3 col-xs-4 no-padding-left @if($errors->has('height')) has-error @endif">
						<input type="number" placeholder="Altura" name="height" id="height" class="form-control" value="{{old('height')}}">
						@if ($errors->has('height')) <p class="help-block">{{ $errors->first('height') }}</p> @endif
					</div>
					<div class="form-group col-md-3 col-sm-3 col-xs-4 no-padding-left @if($errors->has('bust_measure')) has-error @endif">
						<input type="number" placeholder="Busto" name="bust_measure" id="bust_measure" class="form-control" value="{{old('bust_measure')}}">
						@if ($errors->has('bust_measure')) <p class="help-block">{{ $errors->first('bust_measure') }}</p> @endif
					</div>
					<div class="form-group col-md-3 col-sm-3 col-xs-4 no-padding-left @if($errors->has('waist_measure')) has-error @endif">
						<input type="number" placeholder="Cintura" name="waist_measure" id="waist_measure" class="form-control" value="{{old('waist_measure')}}">
						@if ($errors->has('waist_measure')) <p class="help-block">{{ $errors->first('waist_measure') }}</p> @endif
					</div>

					<div class="form-group col-md-3 col-sm-3 col-xs-4 no-padding-left @if($errors->has('hip_measure')) has-error @endif">
						<input type="number" placeholder="Cadera" name="hip_measure" id="hip_measure" class="form-control" value="{{old('hip_measure')}}">
						@if ($errors->has('hip_measure')) <p class="help-block">{{ $errors->first('hip_measure') }}</p> @endif
					</div>
				</div>

				<div class="form-group col-md-6 col-sm-6 col-xs-12"  @if($errors->has('city_id')) has-error @endif>
					<label class="control-label" for="hobbies">Hobbies </label>
					<textarea name="hobbies" id="hobbies" class="form-control">{{old('hobbies')}}</textarea>
				</div>
			</div>

			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<label class="control-label">Fotos</label>
					<div class="dropzone-area">
                    	<div class="dz-message">
                        	Arrastre las fotos hasta aqui o presione para subirlas.
                    	</div>
                	</div>
				</div>
			</div>
			<hr>
			<div class="row">
				<div class="form-group col-md-12 col-sm-12 col-xs-12">
					<a href="{{ route('misses.index') }}" class="btn btn-primary">Cancelar</a>
	                <button type="submit" class="btn btn-success" id="save">Guardar</button>
	            </div>
			</div>

		</form>
	</div>

</div>
@endsection

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('public/css/dropzone.css') }}">
@endsection

@section('js')
<script src="{{asset('public/js/dropzone.js')}}" type="text/javascript"></script>
<script type="text/javascript">
	$(".dropzone").dropzone({
		paramName:"photos",
		addRemoveLinks: true,
        dictRemoveFile: "Remover foto",
        dictCancelUpload: "Cancelar subida",
        dictInvalidFileType: "No puede subir archivos de este tipo",
        acceptedFiles: "image/*",
        autoProcessQueue: false, //detiene que los archivos no sean subidos al soltarlos
        uploadMultiple: true,
        parallelUploads: 100,
        maxFiles: 100,
        clickable: ".dropzone-area",
        previewsContainer: ".dropzone-area",
        init: function() {

            var submitButton = $("#save")
            // var galeriaId = $("#galeria_id").val();
            myDropzone = this; // closure

            submitButton.click(function(e) {
                e.preventDefault();
                e.stopPropagation();
                myDropzone.processQueue();
            });

            this.on("addedfile", function(file) {
            	console.log(file);
                // var message = $('.dz-message');
                // if (message.is(":visible")) {
                //     message.css('display', 'none');
                // }

            });

            this.on("reset", function(file) {
                $('.dz-message').css('display', 'block')
            });

            this.on("sendingmultiple", function() {
                // window.setTimeout(function() {
                //     document.location.href = '/dashboard/galerias'
                // }, 2000);
            });

            // if (galeriaId) {
            //     $.get('/dashboard/galerias/' + galeriaId + '/contenidos', function(data) {
            //         $.each(data, function(index, el) {
            //             var existingFile = {
            //                 id: el.id,
            //                 name: el.fuente.split('/').pop(),
            //                 size: el.tamanio,
            //                 accepted: true,
            //                 fullPath: document.location.origin + '/' + el.fuente
            //             };

            //             myDropzone.files.push(existingFile);
            //             myDropzone.emit("addedfile", existingFile);
            //             myDropzone.emit("thumbnail", existingFile, existingFile.fullPath);
            //             myDropzone.emit("success", existingFile);
            //             myDropzone.emit("complete", existingFile);
            //         });
            //     });
            // }
        },
        removedfile: function(file) {
            if (!file.id) {
                var _ref;
                if (file.previewElement) {
                    if ((_ref = file.previewElement) != null) {
                        _ref.parentNode.removeChild(file.previewElement);
                    }
                }
                return this._updateMaxFilesReachedClass();
            } else {
                //INSERTAMOS ATRIBUTOS AL OBJETO QUE VAMOS A ELIMINAR
                $(file.previewElement).attr('id', 'item-selected');
                $(file.previewElement).attr('data-contenido', file.id);
                //si la foto tiene id aparecerá el modal 
                $('#eliminacionContenidoGaleriaModal').modal('show');
            }
        },
	});
</script>
@endsection