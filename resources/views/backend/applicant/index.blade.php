@extends('layouts.backend')
@section('content')
<div class="panel panel-default">
  <div class="panel-heading">{{ trans('backend.applicant.index.panel_title') }}</div>

  <div class="panel-body">
  	   @if (Session::has('mensaje'))
        <div class="alert alert-disapplicantible @if(Session::get('tipo_mensaje') == 'success') alert-info  @endif @if(Session::get('tipo_mensaje') == 'error') alert-danger  @endif" role="alert">
          <button type="button" class="close" data-disapplicant="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
          {{session('mensaje')}}
           </div>
        <div class="clearfix"></div>
       @endif

      
      <h5><b>{{ trans('backend.applicant.index.filter.label_title') }}</b></h5>
      <div class="well" id="filters">
        <form action="{{ route('applicants.index') }}" method="GET">
          <div class="row">
                <input type="hidden" name="casting_id" value="{{Request::get('casting_id')}}">
                  <div class="form-group col-md-3 col-sm-3 col-xs-12">
                    <label class="control-label">{{ trans('backend.applicant.index.filter.country_label') }} </label>
                    <select name="country_id" id="country" class="form-control">
                      <option value="null">{{trans('backend.applicant.index.filter.all')}}</option>
                      @foreach ($countries  as $country)
                      <option value="{{$country->id}}" @if($country->id == Request::get('country_id'))) selected @endif>{{$country->name}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group col-md-2 col-sm-3 col-xs-12">
                    <label class="control-label">{{ trans('backend.applicant.index.filter.state_label') }} </label>
                    <select name="state" id="state" class="form-control">
                     <option value="null">{{trans('backend.applicant.index.filter.all')}}</option>
                      <option value="0" @if('0' == Request::get('state')) selected @endif>{{trans('backend.miss.states.for_evaluate')}}</option>
                      <option value="1" @if(1 == Request::get('state')) selected @endif>{{trans('backend.miss.states.preselected')}}</option>
                      <option value="2" @if(2 == Request::get('state')) selected @endif>{{trans('backend.miss.states.no_preselected')}}</option>
                    </select>
                  </div>
                  <div class="form-group col-md-4 col-sm-3 col-xs-12">
                    <div class="form-group col-md-6 col-sm-2 col-xs-4 no-padding">
                      <label class="control-label col-md-12 col-sm-12 col-xs-12">{{ trans('backend.applicant.index.filter.label_from') }}</label>
                      <input type="date"  name="date_from" id="height" class="form-control" value="{{Request::get('date_from')}}">
                    </div>
                    <div class="form-group col-md-6 col-sm-2 col-xs-4 no-padding">
                      <label class="control-label col-md-12 col-sm-12 col-xs-12 no-padding">{{ trans('backend.applicant.index.filter.label_to') }}</label>
                      <input type="date"  name="date_to" id="height" class="form-control" value="{{Request::get('date_to')}}">
                    </div>
                  </div>
                    <div class="form-group col-md-3 col-sm-3 col-xs-12 no-padding text-center">
                        <br> 
                      <button type="submit" class="btn btn-primary">{{ trans('backend.applicant.index.filter.btn_search') }}</button>
                      <div class="btn-group">
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ trans('backend.dashboard.export') }}  <span class="caret"></span></button>
                        <ul class="dropdown-menu">
                          <li><a target="_blank" href="{{ route('applicants.export',Request::all()) }}"><i class="fa fa-file-pdf-o"> </i> PDF</a></li>
                          <li><a target="_blank" href="{{ route('applicants.export',array_merge(Request::all(),['format'=>'xls']) ) }}"><i class="fa fa-file-excel-o"> </i> EXCEL</a></li>
                        </ul>
                      </div>
                    </div>
          </div>
        </form>
        <div class="row">
           <div class="form-group col-md-12 col-sm-12 col-xs-12">
              <button type="button" id="send-mail-nopreselected" class="btn btn-default" disabled>{{ trans('backend.applicant.index.filter.btn_gratitude') }}</button>
              <button type="button" id="send-mail-preselected" class="btn btn-success" disabled>{{ trans('backend.applicant.index.filter.btn_selected') }}</button>
           </div>
        </div>
      </div>
      
      <table id="applicant-datatable" class="table table-bordered">
         		<caption>{{ trans('backend.applicant.index.panel_caption') }}</caption>
         		<thead>
         			<tr>
                <th>
                  @if ( Request::get('state') == 1 && count($applicants) > 0)
                    <input type="checkbox" id="select_all_preselected">
                  @endif
                  @if (Request::get('state') == 2 && count($applicants) > 0)
                    <input type="checkbox" id="select_no_all_preselected">
                  @endif
                </th>
                <th>{{ trans('backend.applicant.index.th_creation_date') }}</th>
                <th>{{ trans('backend.applicant.index.th_number') }}</th>
         				<th>Email</th>
                <th>{{ trans('backend.applicant.index.th_code') }}</th>
                <th>{{ trans('backend.applicant.index.th_names') }}</th>
                <th>{{ trans('backend.applicant.index.th_state') }}</th>
                <th>{{ trans('backend.applicant.index.th_how_you_hear') }}</th>
         				<th>{{ trans('backend.applicant.index.th_action') }}</th>
         			</tr>
         		</thead>
         		<tbody>
              @for ($i = count($applicants) - 1; $i >= 0; $i--)
                <tr>
                  <td>
                    @if($applicants[$i]->state == MissVote\Models\Miss::PRESELECTED && !$applicants[$i]->mail_sended)
                      <input class="preselected" type="checkbox" name="applicants[]" value="{{$applicants[$i]->id}}">
                    @endif 
                    @if($applicants[$i]->state == MissVote\Models\Miss::NOPRESELECTED && !$applicants[$i]->mail_sended)
                      <input class="nopreselected" type="checkbox" name="applicants[]" value="{{$applicants[$i]->id}}">
                    @endif
                    <input type="hidden" value="" id="id-preselecteds">
                    <input type="hidden" value="" id="id-nopreselecteds">
                  </td>
           				<td>{{$applicants[$i]->created_at }}</td>
                  <td>{{$i + 1}}</td>
                  <td>{{$applicants[$i]->email}}</td>
                  <td>{{$applicants[$i]->code }}</td>
                  <td>{{$applicants[$i]->name}} {{$applicants[$i]->last_name}}</td>
                  <td>@if($applicants[$i]->state == 0) <span class="text-danger">  @endif{{$applicants[$i]->getFormattedState()}} @if($applicants[$i]->state == 0) </span> @endif</td>
                  <td>{{$applicants[$i]->getFormattedHowDidYouHearAboutUs()}}</td>
           				<td class="text-center">
                    <form action="{{ route('applicants.destroy',$applicants[$i]->id) }}" method="POST">
                        <a href="{{ route('applicants.show',$applicants[$i]->id) }}" title="{{ trans('backend.applicant.index.td_show') }}" class="btn btn-xs btn-warning"> {{ trans('backend.applicant.index.td_show') }}</a>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" title="{{ trans('backend.applicant.index.td_delete') }}" class="btn btn-xs btn-danger delete"> {{ trans('backend.applicant.index.td_delete') }}</button>
                    </form>
           				</td>
           			</tr>
              @endfor
         		</tbody>
      </table>
       
  </div>
</div>


<div class="panel panel-default col-md-6">
  <div class="panel-heading">{{trans('backend.dashboard.resume_country_casting.panel_heading_count_country_social')}}
      <div class="btn-group">
      <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ trans('backend.dashboard.export') }}  <span class="caret"></span></button>
      <ul class="dropdown-menu">
        <li><a target="_blank" href="{{ route('dashboard.export.countries-network-casting',['casting_id'=>$currentCasting->key,'country_id'=>Request::get('country_id')]) }}"><i class="fa fa-file-pdf-o"> </i> PDF</a></li>
        <li><a target="_blank" href="{{ route('dashboard.export.countries-network-casting',['casting_id'=>$currentCasting->key,'country_id'=>Request::get('country_id'),'format'=>'xls']) }}"><i class="fa fa-file-excel-o"> </i> EXCEL</a></li>
      </ul>
    </div>
    </div>
    <div class="panel-body">
      <table id="casting-1-datatable" class="table table-bordered">
        <thead>
          <tr>
            <th>{{trans('backend.dashboard.resume_country_casting.th_social_network')}}</th>
            <th>{{trans('backend.dashboard.resume_country_casting.th_count')}}</th>
          </tr>
        </thead>
        <tbody>
          @if (count($socialMediaMoreUsed))
            @foreach ($socialMediaMoreUsed as $social)
              <tr>
                <td> {{$social->occurrence}} </td>
                <td> {{$social->counter}} </td>
              </tr>
            @endforeach
          @else
            <tr>
              <td colspan="2">{{ trans('backend.no-data') }}</td>
            </tr>
          @endif
        </tbody>
      </table>
  </div>
</div>
@endsection


@section('js')
<script type="text/javascript">
  $(document).ready(function(){
      $('#applicant-datatable').DataTable({
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
        "orderable": true,
        "columnDefs": [{
            "orderable": false,
            "targets": [0,7]
        }],
        "order": [
            [1, 'asc'],
            [2, 'asc'],
            [3, 'asc'],
        ],
        "responsive": true
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

  //CHECKBOX
  $(document).ready(function() {

    var actionSendMailPreselecteds = false;

    //si hay preselecteds
    $(".preselected").on('click',function(event) {
      var _this = $(this);
      if(_this.is(':checked')){
        $("#send-mail-preselected").removeAttr('disabled',true);       

      } else if(!$(".preselected").is(':checked')) {

        $("#send-mail-preselected").attr('disabled',true);
      } else {
        $("#applicant_"+parseInt(_this.val())+"").remove();
      }
    });

    //si hay preselecteds
    $(".nopreselected").on('click',function(event) {
      var _this = $(this);
      if(_this.is(':checked')){
        $("#send-mail-nopreselected").removeAttr('disabled',true);
      } else if(!$(".nopreselected").is(':checked')) {
        $("#send-mail-nopreselected").attr('disabled',true);
      }
    });

    $("#send-mail-preselected").on('click',function(event) {
        $("#modal-send-mail").modal('show');
        actionSendMailPreselecteds = true;
    });

    $("#send-mail-nopreselected").on('click',function(event) {
        $("#modal-send-mail").modal('show');
        actionSendMailPreselecteds = false;
    });

    $("#modal-send-mail").on('hidden.bs.modal', function(event) {
      $(".preselecteds-modal").remove();
      $(".nopreselecteds-modal").remove();
    });

    $("#modal-send-mail").on('shown.bs.modal', function(event) {
      if(actionSendMailPreselecteds) {
        var htmlAction = "<input type='hidden' name='action' id='action' value='send_preselected' />";
        $('#applicants_to_send_mail').append(htmlAction);
        $(".preselected").each(function(index, el) {
          var el = $(el);
          if(el.is(':checked')){
            var htmlHidden = '<input type="hidden" class="preselecteds-modal" name="applicants[]" value="'+parseInt(el.val())+'" id="applicant_'+parseInt(el.val())+'" >';
              $('#applicants_to_send_mail').append(htmlHidden);
          }
        });

      } else {
        var htmlAction = "<input type='hidden' name='action' id='action' value='send_nopreselected' />";
        $('#applicants_to_send_mail').append(htmlAction);
        $(".nopreselected").each(function(index, el) {
          var el = $(el);
          if(el.is(':checked')){
            var htmlHidden = '<input type="hidden" class="nopreselecteds-modal" name="applicants[]" value="'+parseInt(el.val())+'" id="applicant_'+parseInt(el.val())+'" >';
              $('#applicants_to_send_mail').append(htmlHidden);
          }
        });
      }
    });


    //check all
    $("#select_all_preselected").on('click', function(event) {
       var el = $(this);
       if(el.is(':checked')){
          $(".preselected").attr('checked', true);
          $("#send-mail-preselected").removeAttr('disabled',true);
       } else {
          $("#send-mail-preselected").attr('disabled',true);
          $(".preselected").removeAttr('checked', true);

       }
    });

  });
 </script>




<div class="modal fade" id="modal-send-mail" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Preview</h4>
      </div>
      <form action="{{ route('applicants.sendmail') }}" method="POST" id="applicants_to_send_mail">
      <div class="modal-body">
        <div class="row">
            {{ csrf_field() }}
            <div class="form-group col-md-8 col-sm-8 col-xs-12 ">
              <label class="control-label">{{trans('backend.config.tab_mail.subject')}} </label>
              <input type="text" class="form-control" id="email-subject" name="subject" value="{{trim($emailSuccessTemplate['subject'])}}" autofocus>
            </div>
            <div class="form-group col-md-12 col-sm-12 col-xs-12">
              <p><b>{{ trans('backend.config.tab_mail.list_variables') }}</b></p>
              <ul>
                <li>Name : !!name!!</li>
                <li>Last Name : !!lastname!!</li>
                <li>Email: !!email!!</li>
              </ul>
            </div>
            <div class="form-group col-md-12 col-sm-12 col-xs-12 ">
              <label class="control-label">{{trans('backend.config.tab_mail.body')}} </label>
              <textarea type="text" name="body" id="email-body" class="form-control">{{$emailSuccessTemplate['body']}}</textarea>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Send Emails</button>
      </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

@endsection