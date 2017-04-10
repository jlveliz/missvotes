@extends('layouts.backend')
@section('content')
<div class="panel panel-default">
  <div class="panel-heading">Membresias</div>

  <div class="panel-body">
  	   @if (Session::has('mensaje'))
        <div class="alert alert-dismissible @if(Session::get('tipo_mensaje') == 'success') alert-info  @endif @if(Session::get('tipo_mensaje') == 'error') alert-danger  @endif" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
          {{session('mensaje')}}
           </div>
        <div class="clearfix"></div>
       @endif
     	<table id="membership-datatable" class="table table-bordered">
     		<caption>Listado de Membresias <a class="pull-right btn btn-primary" href="{{ route('memberships.create') }}" title="Crear">Crear Membresia</a></caption>
     		<thead>
     			<tr>
     				<th>Nombre</th>
     				<th>Duración</th>
     				<th>Precio</th>
     				<th>Fecha creación/Actualización</th>
     				<th>Acción</th>
     			</tr>
     		</thead>
     		<tbody>
     			@foreach ($memberships as $membership)
       			<tr>
       				<td>{{$membership->name}}</td>
              <td>{{$membership->duration_time}} {{$membership->durationsMode[$membership->duration_mode]}}</td>
       				<td>{{$membership->price}}</td>
       				<td>{{$membership->created_at }} / {{$membership->updated_at}}</td>
       				<td class="text-center">
       					<form action="{{ route('memberships.destroy',$membership->id) }}" method="POST">
       						<a href="{{ route('memberships.edit',$membership->id) }}" title="Editar" class="btn btn-xs btn-warning"> Editar</a>
       							<input type="hidden" name="_token" value="{{ csrf_token() }}">
         						<input type="hidden" name="_method" value="DELETE">
         						<button type="submit" title="Eliminar" class="btn btn-xs btn-danger"> Eliminar</button>
       					</form>
       				</td>
       			</tr>
     			@endforeach
     		</tbody>
     	</table>
  </div>
</div>
@endsection


@section('js')
<script type="text/javascript">
  $(document).ready(function(){
      $('#membership-datatable').DataTable({
        "language": {
          "url": "../public/js/datatables/json/es.json"
        }
      });
  });
 </script>
@endsection