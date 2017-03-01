@extends('layouts.backend')
@section('content')
<div class="panel panel-default">
  <div class="panel-heading">Usuarios</div>

  <div class="panel-body">
  	   @if (Session::has('mensaje'))
        <div class="alert alert-dismissible @if(Session::get('tipo_mensaje') == 'success') alert-info  @endif @if(Session::get('tipo_mensaje') == 'error') alert-danger  @endif" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
          {{session('mensaje')}}
           </div>
        <div class="clearfix"></div>
       @endif
     	<table id="user-datatable" class="table table-bordered">
     		<caption>Listado de Usuarios <a class="pull-right btn btn-primary" href="{{ route('users.create') }}" title="Crear">Crear </a></caption>
     		<thead>
     			<tr>
     				<th>Nombre</th>
     				<th>Email</th>
     				<th>Dirección</th>
     				<th>Último Acceso</th>
     				<th>Fecha creación/Actualización</th>
     				<th>Acción</th>
     			</tr>
     		</thead>
     		<tbody>
     			@foreach ($users as $user)
       			<tr>
       				<td>{{$user->name}}</td>
       				<td>{{$user->email}}</td>
       				<td>{{$user->address}}</td>
       				<td>@if($user->last_login){{$user->last_login}} @else - @endif</td>
       				<td>{{$user->created_at }} / {{$user->updated_at}}</td>
       				<td class="text-center">
       					<form action="{{ route('users.destroy',$user->id) }}" method="POST">
       						<a href="{{ route('users.edit',$user->id) }}" title="Editar" class="btn btn-xs btn-warning"> Editar</a>
       						@if (Auth::user()->id != $user->id)
         						<input type="hidden" name="_token" value="{{ csrf_token() }}">
         						<input type="hidden" name="_method" value="DELETE">
         						<button type="submit" title="Eliminar" class="btn btn-xs btn-danger"> Eliminar</button>
       						@endif
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
      $('#user-datatable').DataTable({
        "language": {
          "url": "../public/js/datatables/json/es.json"
        }
      });
  });
 </script>
@endsection