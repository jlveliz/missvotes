@extends('layouts.errors')
@section('title','404')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="error-template">
                <h1>
                    Oops!</h1>
                <h2>
                    404 No existe</h2>
                <div class="error-details">
                    Lo Siento un error ha ocurrido, la página no existe
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