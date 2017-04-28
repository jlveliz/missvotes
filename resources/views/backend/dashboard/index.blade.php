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
        "language": {
          "url": "../public/js/datatables/json/es.json",
        },
        "order": [[ 2, "desc" ]],
        "ordering": false,
      });

      $('#memberships-datatable').DataTable({
        "language": {
          "url": "../public/js/datatables/json/es.json",
        },
        "ordering": false,
      });

      $('#ticket-datatable').DataTable({
        "language": {
          "url": "../public/js/datatables/json/es.json",
        },
        "ordering": false,
      });
  });
 </script>
@endsection