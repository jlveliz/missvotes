@extends('layouts.errors')
@section('title','500')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="error-template">
                <h1>
                    Oops!</h1>
                <h2>
                    500 Error Interno</h2>
                <div class="error-details">
                    Ah ocurrido un error en la aplicación. Por favor contacte al administrador.
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