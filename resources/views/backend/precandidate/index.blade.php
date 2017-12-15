@extends('layouts.backend')
@section('content')
<div class="panel panel-default">
  <div class="panel-heading">{{ trans('backend.precandidate.index.panel_title') }}</div>

  <div class="panel-body">
  	   @if (Session::has('mensaje'))
        <div class="alert alert-disprecandidateible @if(Session::get('tipo_mensaje') == 'success') alert-info  @endif @if(Session::get('tipo_mensaje') == 'error') alert-danger  @endif" role="alert">
          <button type="button" class="close" data-disprecandidate="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
          {{session('mensaje')}}
           </div>
        <div class="clearfix"></div>
       @endif

      
      <h5><b>{{ trans('backend.precandidate.index.filter.label_title') }}</b></h5>
      <div class="well" id="filters">
        <form action="{{ route('precandidates.index') }}" method="GET">
          <div class="row">
                  <div class="form-group col-md-3 col-sm-3 col-xs-12">
                    <label class="control-label">{{ trans('backend.precandidate.index.filter.country_label') }} </label>
                    <select name="country_id" id="country" class="form-control">
                      <option value="null">{{ trans('backend.precandidate.index.filter.all') }}</option>
                      @foreach ($countries  as $country)
                      <option value="{{$country->id}}" @if($country->id == Request::get('country_id'))) selected @endif>{{$country->name}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group col-md-2 col-sm-3 col-xs-12">
                    <label class="control-label">{{ trans('backend.precandidate.index.filter.state_label') }} </label>
                    <select name="state" id="state" class="form-control">
                      <option value=null>{{ trans('backend.precandidate.index.filter.all') }}</option>
                      <option value="3" @if(3 == Request::get('state'))) selected @endif>{{ trans("backend.miss.states.precandiate")}}</option>
                      <option value="4" @if(4 == Request::get('state'))) selected @endif>{{ trans("backend.miss.states.noprecandidate")}}</option>
                    </select>
                  </div>
                  <div class="form-group col-md-4 col-sm-3 col-xs-12">
                    <div class="form-group col-md-6 col-sm-2 col-xs-4 no-padding-left">
                      <label class="control-label col-md-12 col-sm-12 col-xs-12 no-padding">{{ trans('backend.precandidate.index.filter.label_from') }}</label>
                      <input type="date"  name="date_from" id="height" class="form-control" value="{{Request::get('date_from')}}">
                    </div>
                    <div class="form-group col-md-6 col-sm-2 col-xs-4 no-padding-left">
                      <label class="control-label col-md-12 col-sm-12 col-xs-12 no-padding">{{ trans('backend.precandidate.index.filter.label_to') }}</label>
                      <input type="date"  name="date_to" id="height" class="form-control" value="{{Request::get('date_to')}}">
                    </div>
                  </div>
                    <div class="form-group col-md-3 col-sm-3 col-xs-12">
                        <br> 
                      <button type="submit" class="btn btn-primary">{{trans('backend.precandidate.index.filter.btn_search')}}</button>
                       <div class="btn-group">
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ trans('backend.dashboard.export') }}  <span class="caret"></span></button>
                        <ul class="dropdown-menu">
                          <li><a target="_blank" href="{{ route('precandidates.export',Request::all()) }}"><i class="fa fa-file-pdf-o"> </i> PDF</a></li>
                          <li><a target="_blank" href="{{ route('precandidates.export',array_merge(Request::all(),['format'=>'xls']) ) }}"><i class="fa fa-file-excel-o"> </i> EXCEL</a></li>
                        </ul>
                      </div>
                      
                    </div>
          </div>
        </form>
      </div>
      
      <table id="precandidate-datatable" class="table table-bordered">
         		<caption>{{ trans('backend.precandidate.index.panel_caption') }}</caption>
         		<thead>
         			<tr>
         				<th>{{ trans('backend.precandidate.index.th_creation_date') }}</th>
                <th>{{ trans('backend.precandidate.index.th_code') }}</th>
                <th>Email</th>
                <th>{{ trans('backend.precandidate.index.th_names') }}</th>
                <th>{{ trans('backend.precandidate.index.th_state') }}</th>
                <th>{{ trans('backend.precandidate.index.th_how_you_hear') }}</th>
         				<th>{{ trans('backend.precandidate.index.th_action') }}</th>
         			</tr>
         		</thead>
         		<tbody>
         			 @for ($i = count($precandidates) - 1; $i >= 0; $i--)
                <tr>
           				<td>{{$precandidates[$i]->created_at }}</td>
                  <td>{{$precandidates[$i]->code }}</td>
                  <td>{{$precandidates[$i]->email }}</td>
                  <td>{{$precandidates[$i]->name}} {{$precandidates[$i]->last_name}}</td>
                  <td>{{$precandidates[$i]->getFormattedState()}}</td>
                  <td>{{$precandidates[$i]->getFormattedHowDidYouHearAboutUs()}}</td>
           				<td class="text-center">
                    <a href="{{ route('precandidates.show',$precandidates[$i]->id) }}" title="{{ trans('backend.precandidate.index.td_show') }}" class="btn btn-xs btn-warning"> {{ trans('backend.precandidate.index.td_show') }}</a>
           				</td>
           			</tr>
         			@endfor
         		</tbody>
      </table>
       
  </div>
</div>
@endsection


@section('js')
<script type="text/javascript">
  $(document).ready(function(){
      $('#precandidate-datatable').DataTable({
        @if (App::isLocale('es'))
        @if(App::isLocal())
          "language": {
            "url": "../public/js/datatables/json/es.json"
          },
          @else
            "language": {
            "url": "../../public/js/datatables/json/es.json"
          },
          @endif
        @endif
      });

       $(".delete").on('click', function(event) {
        event.preventDefault();
        event.stopPropagation();
        var deleteRegister = confirm('Esta usted seguro de eliminar el registro? ');

        if (deleteRegister) {
          $(this).parents('form').submit();
        }
      });
  });
 </script>
@endsection