@extends('layouts.backend')
@section('content')
<div class="panel panel-default">
  <div class="panel-heading">Clientes</div>

  <div class="panel-body">
  	   @if (Session::has('mensaje'))
        <div class="alert alert-dismissible @if(Session::get('tipo_mensaje') == 'success') alert-info  @endif @if(Session::get('tipo_mensaje') == 'error') alert-danger  @endif" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
          {{session('mensaje')}}
           </div>
        <div class="clearfix"></div>
       @endif
     	<table id="client-datatable" class="table table-bordered">
     		<caption>Listado de Clientes <a class="pull-right btn btn-primary" href="{{ route('clients.create') }}" title="Crear">Crear Cliente</a></caption>
     		<thead>
     			<tr>
            <th>Cuenta</th>
     				<th>Nombre</th>
     				<th>Email</th>
     				<th>Dirección</th>
     				<th>Último Acceso</th>
     				<th>Fecha creación/Actualización</th>
     				<th>Acción</th>
     			</tr>
     		</thead>
     		<tbody>
     			@foreach ($clients as $client)
       			<tr  @if(!$client->confirmed) class="warning" @endif>
              <td>{{ $client->current_membership() ? $client->current_membership()->membership->name : 'Free' }}</td>
       				<td>{{$client->name}}  @if(!$client->confirmed) <small><i>(Sin confirmar)</i> </small> @endif</td>
       				<td>{{$client->email}}</td>
       				<td>{{$client->address}}</td>
       				<td>@if($client->last_login){{$client->last_login}} @else - @endif</td>
       				<td>{{$client->created_at }} / {{$client->updated_at}}</td>
       				<td class="text-center">
       					<form action="{{ route('clients.destroy',$client->id) }}" method="POST">
       						<a href="{{ route('clients.edit',$client->id) }}" title="Editar" class="btn btn-xs btn-warning"> Editar</a>
       						@if (Auth::user()->id != $client->id)
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
      $('#client-datatable').DataTable({
        "language": {
          "url": "../public/js/datatables/json/es.json"
        }
      });
  });
 </script>
@endsection