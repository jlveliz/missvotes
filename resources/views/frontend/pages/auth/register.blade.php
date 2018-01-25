@extends('layouts.frontend')
@section('content')
  <div class="row">
    <div class="col-md-4 col-lg-4 col-xs-12 col-md-offset-4 container-page-auth">
      <div class="row">
          <div class="col-md-12 text-center">
              <img class="image-responsive"  src="{{ asset('public/images/logo_square.png') }}" alt=" {{config('app.name')}} " title=" {{config('app.name')}} ">
           </div> 
        </div>
      <h1 class="text-center">{{ trans('auth.register_title') }}</h1><br>
      <form role="form" action="{{ route('client.register') }}" method="POST">
        {{ csrf_field() }}
        <div class="form-group  {{ $errors->has('email') ? ' has-error' : '' }}">
            <label class="control-label">{{ trans('auth.register_fields.email') }}</label>
            <input type="email" class="form-control" name="email" id="register-email" placeholder="" value="{{ old('email') }}" autofocus required>
            @if ($errors->has('email'))
                <span class="help-block"><strong>{{ $errors->first('email') }}</strong></span>
            @endif
        </div>

        <div class="form-group {{ $errors->has('name') || $errors->has('last_name') ? ' has-error' : '' }}">
          <div class="row">
            <div class="col-md-6">
                <label class="control-label">{{ trans('auth.register_fields.name') }}</label>
                <input type="text" class="form-control" name="name" id="register-name" placeholder="" value="{{ old('name') }}">
                 @if ($errors->has('name'))
                  <span class="help-block"><strong>{{ $errors->first('name') }}</strong></span>
                  @endif
            </div>
            <div class="col-md-6">
                <label class="form-label">{{ trans('auth.register_fields.last_name') }}</label>
                <input type="text" class="form-control" name="last_name" id="register-lastname" placeholder="" value="{{ old('last_name')}}">
                @if ($errors->has('last_name'))
                 <span class="help-block"><strong>{{ $errors->first('last_name') }}</strong></span>
                 @endif
            </div>
          </div>
        </div>

        <div class="form-group {{ $errors->has('country_id') ? ' has-error' : '' }}">
          <label class="form-label">{{ trans('auth.register_fields.country-select') }}</label>
          <select class="form-control" name="country_id" id="country">
            @foreach (\MissVote\Models\Country::orderby('name')->get() as $country)
              <option value="{{ $country->id }}" @if($country->id == old('country_id')) selected @endif>{{ $country->name }}</option>
            @endforeach
          </select>
           @if ($errors->has('country_id'))
              <span class="help-block"><strong>{{ $errors->first('country_id') }}</strong></span>
          @endif
        </div>

        <div class="form-group {{ $errors->has('gender') ? ' has-error' : '' }}">
          <label class="form-label">{{ trans('auth.register_fields.gender') }}</label>
          <select class="form-control" name="gender" id="gender">
            <option value="male" @if('male' == old('gender')) selected @endif>{{ trans('auth.register_fields.male') }}</option>
            <option value="female" @if('female' == old('gender')) selected @endif>{{ trans('auth.register_fields.female') }}</option>
          </select>
          @if ($errors->has('gender'))
              <span class="help-block"><strong>{{ $errors->first('gender') }}</strong></span>
          @endif
        </div>

        <div class="form-group {{ $errors->has('city') ? ' has-error' : '' }}">
            <label class="form-label">{{ trans('auth.register_fields.city') }}</label>
            <input type="text" class="form-control" name="city" id="city" placeholder="" value="{{ old('city') }}">
             @if ($errors->has('city'))
              <span class="help-block"><strong>{{ $errors->first('city') }}</strong></span>
          @endif
        </div>

        <div class="form-group {{ $errors->has('address') ? ' has-error' : '' }}">
            <label class="form-label">{{ trans('auth.register_fields.address') }}</label>
            <input type="text" class="form-control" name="address" id="register-address" placeholder="" value="{{ old('address') }}">
             @if ($errors->has('address'))
              <span class="help-block"><strong>{{ $errors->first('address') }}</strong></span>
          @endif
        </div>
        
        <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
            <label class="form-label">{{ trans('auth.register_fields.password') }}</label>
            <input type="password" class="form-control" name="password" id="register-password" placeholder="">
             @if ($errors->has('password'))
              <span class="help-block"><strong>{{ $errors->first('password') }}</strong></span>
          @endif
        </div> 

        <div class="form-group {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
            <label class="form-label">{{ trans('auth.register_fields.confirm_password') }}</label>
            <input type="password" class="form-control" name="password_confirmation" id="register-password-confirmation" placeholder="">
            @if ($errors->has('password_confirmation'))
              <span class="help-block"><strong>{{ $errors->first('password_confirmation') }}</strong></span>
          @endif
        </div>

        <div class="form-group {{ $errors->has('accept_terms_conditions') ? ' has-error' : '' }}">
            <label class="form-label"><input type="checkbox" name="accept_terms_conditions" >{!! trans('auth.register_fields.accept_terms') !!}</label>
            
            @if ($errors->has('accept_terms_conditions'))
              <span class="help-block"><strong>{{ $errors->first('accept_terms_conditions') }}</strong></span>
          @endif
        </div>

        <input type="submit" name="register" id="register" class="register btn btn-primary btn-block registermodal-submit" value="{{ trans('auth.register_options.register') }}">
      </form>
      
      <div class="register-help">
        <a href="{{ route('client.show.login') }}">{{ trans('auth.register_options.login') }}</a>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-4 col-lg-4 col-xs-12 col-md-offset-4">
      <h4 class="text-center">{{ trans('auth.register_fields.follows') }}</h4>
      <ul class="list-inline text-center">
        <li><a href="https://www.facebook.com/MissPanamericanInternational" target="_blank" title="Facebook"><i class="fa fa-facebook-official fa-lg" aria-hidden="true"></i></a></li>
        <li><a href="https://www.twitter.com/MissPanamerican" target="_blank" title="Twitter"><i class="fa fa-twitter fa-lg" aria-hidden="true"></i></a></li>
        <li><a href="https://www.instagram.com/misspanamericaninternational" target="_blank" title="Instagram"><i class="fa fa-instagram fa-lg" aria-hidden="true"></i></a></li>
        <li><a href="https://www.youtube.com/misspanamerican1" target="_blank" title="Youtube"><i class="fa fa-youtube-play fa-lg" aria-hidden="true"></i></a></li>
        <li><a href="https://www.flickr.com/misspanamerican" target="_blank" title="Flickr"><i class="fa fa-flickr fa-lg" aria-hidden="true"></i></a></li>
        <li><a href="https://pinterest.com/misspanamerican" target="_blank" title="Pinterest"><i class="fa fa-pinterest fa-lg" aria-hidden="true"></i></a></li>
      </ul>
    </div>
  </div>
@endsection()