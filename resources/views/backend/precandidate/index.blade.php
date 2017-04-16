@extends('layouts.backend')
@section('content')
<div class="panel panel-default">
  <div class="panel-heading">Precandidatas</div>

  <div class="panel-body">
  	   @if (Session::has('mensaje'))
        <div class="alert alert-disprecandidateible @if(Session::get('tipo_mensaje') == 'success') alert-info  @endif @if(Session::get('tipo_mensaje') == 'error') alert-danger  @endif" role="alert">
          <button type="button" class="close" data-disprecandidate="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
          {{session('mensaje')}}
           </div>
        <div class="clearfix"></div>
       @endif
     	<table id="precandidate-datatable" class="table table-bordered">
     		<caption>Listado de Precandidatas</caption>
     		<thead>
     			<tr>
            <th>Nombres</th>
     				<th>Código</th>
            <th>País</th>
     				<th>Estado</th>
     				<th>Fecha creación/Actualización</th>
     				<th>Acción</th>
     			</tr>
     		</thead>
     		<tbody>
     			@foreach ($precandidates as $precandidate)
       			<tr>
       				<td>{{$precandidate->name}} {{$precandidate->last_name}}</td>
              <td>{{ $precandidate->code }}</td>
       				<td>@if($precandidate->country) {{$precandidate->country->name}} @else - @endif</td>
       				<td>@if($precandidate->state == '1') Por Evaluar @else Descalificada @endif</td>
       				<td>{{$precandidate->created_at }} / {{$precandidate->updated_at}}</td>
       				<td class="text-center">
                <form action="{{ route('precandidates.destroy',$precandidate->id) }}" method="POST">
                    <a href="{{ route('precandidates.show',$precandidate->id) }}" title="Ver" class="btn btn-xs btn-warning"> Ver</a>
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
      $('#precandidate-datatable').DataTable({
        "language": {
          "url": "../public/js/datatables/json/es.json"
        }
      });
  });
 </script>
@endsection