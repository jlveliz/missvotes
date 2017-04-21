@extends('layouts.backend')
@section('content')
	<div class="row">
		<div class="col-md-8 col-lg-8 col-xs-12">
			@include('backend.reports.ranking-miss',$votes)
		</div>	
		<div class="col-md-4 col-lg-4 col-xs-12">
			@include('backend.reports.memberships-user',$countUserMemberships)
		</div>	
	</div>
@endsection

@section('js')
<script type="text/javascript">
  $(document).ready(function(){
      // $('#ranking-datatable').DataTable({
      //   "language": {
      //     "url": "../public/js/datatables/json/es.json",
      //   },
      //   "order": [[ 2, "desc" ]],
      //   "ordering": false,
      // });
  });
 </script>
@endsection