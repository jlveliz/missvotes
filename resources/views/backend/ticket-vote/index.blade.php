@extends('layouts.backend')
@section('content')
<div class="panel panel-default">
  <div class="panel-heading">Tickets</div>

  <div class="panel-body">
  	   @if (Session::has('mensaje'))
        <div class="alert alert-dismissible @if(Session::get('tipo_mensaje') == 'success') alert-info  @endif @if(Session::get('tipo_mensaje') == 'error') alert-danger  @endif" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
          {{session('mensaje')}}
           </div>
        <div class="clearfix"></div>
       @endif
     	<table id="tickets-datatable" class="table table-bordered">
     		<caption>Listado de Tickets <a class="pull-right btn btn-primary" href="{{ route('tickets-vote.create') }}" title="Crear">Crear Ticket</a></caption>
     		<thead>
     			<tr>
     				<th>Nombre</th>
     				<th>Valor</th>
     				<th>Precio</th>
     				<th>Fecha creación/Actualización</th>
     				<th>Acción</th>
     			</tr>
     		</thead>
     		<tbody>
     			@foreach ($voteTickets as $ticket)
       			<tr>
       				<td>{{$ticket->name}}</td>
       				<td>{{$ticket->val_vote}}</td>
       				<td>${{$ticket->price}}</td>
       				<td>{{$ticket->created_at }} / {{$ticket->updated_at}}</td>
       				<td class="text-center">
       					<form action="{{ route('tickets-vote.destroy',$ticket->id) }}" method="POST">
       						<a href="{{ route('tickets-vote.edit',$ticket->id) }}" title="Editar" class="btn btn-xs btn-warning"> Editar</a>
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
      $('#tickets-datatable').DataTable({
        "language": {
          "url": "../public/js/datatables/json/es.json"
        }
      });
  });
 </script>
@endsection