@extends('layouts.backend')
@section('content')
<div class="panel panel-default">
  <div class="panel-heading">{{ trans('backend.candidates.index.panel_title') }}</div>

  <div class="panel-body">
       @if (Session::has('mensaje'))
        <div class="alert alert-disapplicantible @if(Session::get('tipo_mensaje') == 'success') alert-info  @endif @if(Session::get('tipo_mensaje') == 'error') alert-danger  @endif" role="alert">
          <button type="button" class="close" data-disapplicant="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
          {{session('mensaje')}}
           </div>
        <div class="clearfix"></div>
       @endif

      
      <h5><b>Filters</b></h5>
      <div class="well" id="filters">
        <form action="{{ route('candidates.index') }}" method="GET">
          <div class="row">
                  <div class="form-group col-md-3 col-sm-3 col-xs-12">
                    <label class="control-label">{{ trans('backend.candidates.index.filter.country_label') }} </label>
                    <select name="country_id" id="country" class="form-control">
                      <option value="null">All</option>
                      @foreach ($countries  as $country)
                      <option value="{{$country->id}}" @if($country->id == Request::get('country_id'))) selected @endif>{{$country->name}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group col-md-2 col-sm-3 col-xs-12">
                    <label class="control-label">{{ trans('backend.candidates.index.filter.state_label') }} </label>
                    <select name="state" id="state" class="form-control">
                      <option value=null>All</option>
                      <option value="5" @if(5 == Request::get('state'))) selected @endif>Candidate</option>
                      <option value="6" @if(6 == Request::get('state'))) selected @endif>Disqualified Miss</option>
                    </select>
                  </div>
                  <div class="form-group col-md-5 col-sm-3 col-xs-12">
                    <div class="form-group col-md-6 col-sm-2 col-xs-4 no-padding-left">
                      <label class="control-label col-md-12 col-sm-12 col-xs-12 no-padding">From</label>
                      <input type="date"  name="date_from" id="height" class="form-control" value="{{Request::get('date_from')}}">
                    </div>
                    <div class="form-group col-md-6 col-sm-2 col-xs-4 no-padding-left">
                      <label class="control-label col-md-12 col-sm-12 col-xs-12 no-padding">To</label>
                      <input type="date"  name="date_to" id="height" class="form-control" value="{{Request::get('date_to')}}">
                    </div>
                  </div>
                    <div class="form-group col-md-2 col-sm-3 col-xs-12">
                        <br> 
                      <button type="submit" class="btn btn-primary">Search</button>
                      <a target="_blank" href="{{ route('candidates.export',Request::all()) }}"  type="button" class="btn btn-default"><i class="fa fa-file-pdf-o"> </i> PDF</a>
                    </div>
          </div>
        </form>
      </div>
      
      <table id="candidates-datatable" class="table table-bordered">
            <caption>{{ trans('backend.candidates.index.panel_caption') }}</caption>
            <thead>
              <tr>
                <th>{{ trans('backend.candidates.index.th_creation_date') }}</th>
                <th>{{ trans('backend.candidates.index.th_number') }}</th>
                <th>{{ trans('backend.candidates.index.th_code') }}</th>
                <th>{{ trans('backend.candidates.index.th_names') }}</th>
                <th>{{ trans('backend.candidates.index.th_state') }}</th>
                <th>{{ trans('backend.candidates.index.th_how_you_hear') }}</th>
                <th>{{ trans('backend.candidates.index.th_action') }}</th>
              </tr>
            </thead>
            <tbody>
              @for ($i = count($candidates) - 1; $i >= 0; $i--)
                <tr>
                  <td>{{$candidates[$i]->created_at }}</td>
                  <td>{{$i + 1}}</td>
                  <td>{{$candidates[$i]->code }}</td>
                  <td>{{$candidates[$i]->name}} {{$candidates[$i]->last_name}}</td>
                  <td>@if($candidates[$i]->state == 0) <span class="text-danger">  @endif{{$candidates[$i]->getFormattedState()}} @if($candidates[$i]->state == 0) </span> @endif</td>
                  <td>{{$candidates[$i]->getFormattedHowDidYouHearAboutUs()}}</td>
                  <td class="text-center">
                    <form action="{{ route('candidates.destroy',$candidates[$i]->id) }}" method="POST">
                        <a href="{{ route('candidates.edit',$candidates[$i]->id) }}" title="{{ trans('backend.candidates.index.td_edit') }}" class="btn btn-xs btn-warning"> {{ trans('backend.candidates.index.td_edit') }}</a>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" title="{{ trans('backend.candidates.index.td_delete') }}" class="btn btn-xs btn-danger delete"> {{ trans('backend.candidates.index.td_delete') }}</button>
                    </form>
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
      $('#candidates-datatable').DataTable({
        @if (App::isLocale('es'))
        "language": {
          "url": "../public/js/datatables/json/es.json"
        }
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