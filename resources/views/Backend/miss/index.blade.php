@extends('layouts.backend')
@section('content')
<div class="panel panel-default">
  <div class="panel-heading">Candidatas</div>

  <div class="panel-body">
  	   @if (Session::has('mensaje'))
        <div class="alert alert-dismissible @if(Session::get('tipo_mensaje') == 'success') alert-info  @endif @if(Session::get('tipo_mensaje') == 'error') alert-danger  @endif" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
          {{session('mensaje')}}
           </div>
        <div class="clearfix"></div>
       @endif
     	<table id="miss-datatable" class="table table-bordered">
     		<caption>Listado de Candidatas <a class="pull-right btn btn-primary" href="{{ route('misses.create') }}" title="Crear">Crear </a></caption>
     		<thead>
     			<tr>
     				<th>Nombres</th>
            <th>Ciudad</th>
     				<th>Dirección</th>
     				<th>Fecha creación/Actualización</th>
     				<th>Acción</th>
     			</tr>
     		</thead>
     		<tbody>
     			@foreach ($misses as $miss)
       			<tr>
       				<td>{{$miss->name}} {{$miss->last_name}}</td>
       				<td>{{$miss->city->name}}</td>
       				<td>{{$miss->address}}</td>
       				<td>{{$miss->created_at }} / {{$miss->updated_at}}</td>
       				<td class="text-center">
       					<form action="{{ route('misses.destroy',$miss->id) }}" method="POST">
       						<a href="{{ route('misses.edit',$miss->id) }}" title="Editar" class="btn btn-xs btn-warning"> Editar</a>
       						@if (Auth::user()->id != $miss->id)
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
      $('#miss-datatable').DataTable({
        "language": {
          "url": "../public/js/datatables/json/es.json"
        }
      });
  });
 </script>
@endsection