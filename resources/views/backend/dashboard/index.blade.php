@extends('layouts.backend')
@section('content')
	<div class="row">
		<div class="col-md-6 col-lg-6 col-xs-12">
			@include('backend.reports.ranking-miss',$votes)
		</div>	
		<div class="col-md-6 col-lg-6 col-xs-12">
      @include('backend.reports.memberships-user',$countUserMemberships)
    </div>  
  </div>
  <div class="row">
    <div class="col-md-6 col-lg-6 col-xs-12">
			@include('backend.reports.purchased-tickets',$tickets)
		</div>
  </div>
@endsection

@section('js')
<script type="text/javascript">
  $(document).ready(function(){
      $('#ranking-datatable').DataTable({
        @if (App::isLocale('es'))
          "language": {
            "url": "../public/js/datatables/json/es.json",
          },
        @endif
        "order": [[ 2, "desc" ]],
        "ordering": false,
      });

      $('#memberships-datatable').DataTable({
        @if (App::isLocale('es'))
        "language": {
          "url": "../public/js/datatables/json/es.json",
        },
        @endif
        "ordering": false,
      });

      $('#ticket-datatable').DataTable({
        @if (App::isLocale('es'))
        "language": {
          "url": "../public/js/datatables/json/es.json",
        },
        @endif
        "ordering": false,
      });
  });
 </script>
@endsection