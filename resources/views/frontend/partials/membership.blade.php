<div class="col-xs-12 col-md-3">
    <div class="panel @if (!Auth::user()->client->current_membership()) panel-primary @else panel-success @endif">
        <div class="panel-heading">
            <h3 class="panel-title">
                Free @if (!Auth::user()->client->current_membership())
                    <br>
                        <b>(Su membresia Actual)</b>
                @endif</h3>
        </div>
        <div class="panel-body">
            <div class="the-price">
                <h1>
                    $0.00<span class="subscript"></span></h1>
            </div>
            <table class="table">
                <tr>
                    <td>
                        <b>Voto: </b>1 punto diario por candidata
                    </td>
                </tr>
                <tr class="active">
                    <td>
                        Registro de actividades
                    </td>
                </tr>
            </table>
        </div>
        @if (Auth::user()->client->current_membership())
            <div class="panel-footer">
                <a href="#" class="btn btn-success" role="button">Actualizar</a>
            </div>
        @endif
    </div>
</div>
{{-- memberships --}}
@foreach ($memberships as $membership)
    <div class="col-xs-12 col-md-3">
        <div class="panel @if (Auth::user()->client->current_membership() && (Auth::user()->client->current_membership()->membership_id ==  $membership->id) ) panel-primary @else  panel-success @endif">
                  {{--   @if ($membership->name == 'Premium')
            <div class="cnrflash">
                <div class="cnrflash-inner">
                        <span class="cnrflash-label">Más
                            <br>
                            POPULAR</span>
                </div>
            </div>
                    @endif --}}
            <div class="panel-heading">
                <h3 class="panel-title">
                    {{$membership->name}}
                    @if (Auth::user()->client->current_membership() && (Auth::user()->client->current_membership()->membership_id ==  $membership->id) )
                    <br>
                        <b>(Su membresia Actual)</b>
                @endif
                </h3>
            </div>
            <div class="panel-body">
                <div class="the-price">
                    <h1>
                        ${{$membership->price}}</h1>
                    {{-- <small>1 month FREE trial</small> --}}
                </div>
                <table class="table">
                    <tr>
                        <td>
                           <b> Duración : </b>{{$membership->duration_time}} {{$membership->getDurationMode($membership->duration_mode)}}
                        </td>
                    </tr>
                    <tr class="active">
                        <td>
                            <b> Votos: </b> {{$membership->points_per_vote}} puntos diarios por candidata
                        </td>
                    </tr>
                </table>
            </div>
            @if (!Auth::user()->client->current_membership() || !(Auth::user()->client->current_membership()->membership_id ==  $membership->id) )
                <div class="panel-footer">
                    <a href="#" class="btn btn-success" role="button"> <i class="fa fa-refresh"></i> Actualizar</a>
                </div>
            @endif
        </div>
    </div>
@endforeach
