@extends('layouts.errors')
@section('title','403')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="error-template">
                <h1>
                    Oops!</h1>
                <h2>
                    Área restringida</h2>
                <div class="error-details">
                   Lo sentimos pero no tiene acceso a esta área
                </div>
                <div class="error-actions">
                    <a href="{{ url('/') }}" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-home"></span>
                        Volver </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection