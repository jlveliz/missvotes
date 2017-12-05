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
    <div class="col-md-6 col-lg-6 col-xs-12">
        @include('backend.reports.resume-country-casting',['casting'=>$socialMediaMoreUsed])
    </div>
  </div>
@endsection

@section('js')
<script type="text/javascript">
  $(document).ready(function(){
      // $('#ranking-datatable').DataTable({
        {{-- @if (App::isLocale('es')) --}}
          // "language": {
          //   "url": "../public/js/datatables/json/es.json",
          // },
        {{-- @endif --}}
        // "order": [[ 2, "desc" ]],
        // "ordering": false,
      // });

      // $('#memberships-datatable').DataTable({
        {{-- @if (App::isLocale('es')) --}}
        // "language": {
          // "url": "../public/js/datatables/json/es.json",
        // },
        {{-- @endif --}}
        // "ordering": false,
      // });

      // $('#ticket-datatable').DataTable({
        {{-- @if (App::isLocale('es')) --}}
        // "language": {
          // "url": "../public/js/datatables/json/es.json",
        // },
        {{-- @endif --}}
        // "ordering": false,
      // });

      // $('#casting-1-datatable').DataTable({
      {{-- //   @if (App::isLocale('es')) --}}
      //   "language": {
      //     "url": "../public/js/datatables/json/es.json",
      //   },
      {{-- //   @endif --}}
      //   "ordering": false,
      // });

      // $('#casting-2-datatable').DataTable({
      {{-- //   @if (App::isLocale('es')) --}}
      //   "language": {
      //     "url": "../public/js/datatables/json/es.json",
      //   },
      {{-- //   @endif --}}
      //   "ordering": false,
      // });


      // // CASTING 1
      // var totalCastingOneCounter = 0; 
      // var totalCastingOnePreselected = 0;
      // var totalCastingOneNoPreselected = 0; 
      // var totalCastingOneMissing = 0;


      // $("#casting-1-datatable > tbody > tr > td.counter").each(function(index, el) {
      //    totalCastingOneCounter+=  parseInt($(el).text());
      // });

      // $("#casting-1-datatable > tbody > tr > td.preselected").each(function(index, el) {
      //    totalCastingOnePreselected+=  parseInt($(el).text());
      // });

      // $("#casting-1-datatable > tbody > tr > td.nopreselected").each(function(index, el) {
      //    totalCastingOneNoPreselected+=  parseInt($(el).text());
      // });

      // $("#casting-1-datatable > tbody > tr > td.missing").each(function(index, el) {
      //    totalCastingOneMissing+=  parseInt($(el).text());
      // });

      // $("#total_casting_one_counter").text(totalCastingOneCounter);
      // $("#total_casting_one_preselected").text(totalCastingOnePreselected);
      // $("#total_casting_one_no_preselected").text(totalCastingOneNoPreselected);
      // $("#total_casting_one_missing").text(totalCastingOneMissing);
      
      // CASTING 2
      // var totalCastingTwoCounter = 0; 
      // var totalCastingTwoPreselected = 0;
      // var totalCastingTwoNoPreselected = 0; 
      // var totalCastingTwoMissing = 0;


      // $("#casting-2-datatable > tbody > tr > td.counter").each(function(index, el) {
      //    totalCastingOneCounter+=  parseInt($(el).text());
      // });

      // $("#casting-2-datatable > tbody > tr > td.preselected").each(function(index, el) {
      //    totalCastingOnePreselected+=  parseInt($(el).text());
      // });

      // $("#casting-2-datatable > tbody > tr > td.nopreselected").each(function(index, el) {
      //    totalCastingOneNoPreselected+=  parseInt($(el).text());
      // });

      // $("#casting-2-datatable > tbody > tr > td.missing").each(function(index, el) {
      //    totalCastingOneMissing+=  parseInt($(el).text());
      // });

      // $("#total_casting_two_counter").text(totalCastingTwoCounter);
      // $("#total_casting_two_preselected").text(totalCastingTwoPreselected);
      // $("#total_casting_two_no_preselected").text(totalCastingTwoNoPreselected);
      // $("#total_casting_two_missing").text(totalCastingTwoMissing);
  });
 </script>
@endsection