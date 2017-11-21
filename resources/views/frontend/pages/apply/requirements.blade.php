@extends('layouts.frontend')
@section('content')
	<div class="row">
		<h1 class="text-center">@lang('requirement.tittle_process')</h1>
		<div class="col-md-6 col-lg-6 col-xs-12 col-md-offset-3">
			@if (Session::has('message'))
        		<div class="alert alert-dismissible @if(Session::get('type') == 'success') alert-info  @endif @if(Session::get('type') == 'error') alert-danger  @endif" role="alert">
          			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
          			{{session('message')}}
           		</div>
        		<div class="clearfix"></div>
        	@endif
			<ol>
				<li>@lang('requirement.txt_01')</li>
				<li>@lang('requirement.txt_02')</li>
				<li>@lang('requirement.txt_03')</li>
				<li>@lang('requirement.txt_04')</li>
				<li>@lang('requirement.txt_05')</li>
				<li>@lang('requirement.txt_06')</li>
				<li>@lang('requirement.txt_07')</li>
				<li>@lang('requirement.txt_08')</li>
				<li>@lang('requirement.txt_09')</li>
				<li>@lang('requirement.txt_10')</li>
				<li>@lang('requirement.txt_11')</li>
				<li>@lang('requirement.txt_12')</li>
				<li>@lang('requirement.txt_13')</li>
				<li>@lang('requirement.txt_14')</li>
				<li>@lang('requirement.txt_15')</li>
			</ol>
			<form action="{{ route('apply.aceptrequirements') }}" method="POST">
				{{ csrf_field() }}
				<div class="checkbox">
				    <label>
				      <input type="checkbox" name="acept-terms" value="1"><b> @lang('requirement.txt_terms')</b>
				    </label>
				</div>
				<div class="text-center">
					<button type="submit" class="btn btn-primary">@lang('requirement.btn_accept') </button>
				</div>
			</form>
			<br><br>
		</div>
	</div>
@endsection