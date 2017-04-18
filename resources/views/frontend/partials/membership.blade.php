<div class="col-md-8 col-xs-12">
    @if (!Auth::user()->client->current_membership())
        <div class="col-xs-12 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        Free 
                            <br>
                                <b>(Su membresía Actual)</b>
                        </h3>
                </div>
                <div class="panel-body">
                    <div class="the-price">
                        <h1>
                            $0.00<span class="subscript"></span></h1>
                    </div>
                    <table class="table">
                        <tr>
                            <td>
                                <b>Su Voto: </b>1 punto diario por candidata
                            </td>
                        </tr>
                        <tr class="active">
                            <td>
                                Registro de actividades
                            </td>
                        </tr>
                        <tr>
                            <td>
                            Incluye:
                            <ul>
                                <li>Noticias sobre nuestras candidatas</li>
                                <li>Podrás votar online por tu candidata favorita. Tu votación diaria equivaldrá a 1 punto.</li>
                                <li>Acceso a nuestras promociones o sorteos durante todo un año.</li>
                            </ul>
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
    @endif
    {{-- memberships --}}
    @foreach ($memberships as $membership)
        <div class="col-xs-12 col-md-6">
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
                            <b>(Su membresía Actual)</b>
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
                         <tr class="active">
                            <td>
                                <b>Su Voto: </b> {{$membership->points_per_vote}} puntos diarios por candidata
                            </td>
                        </tr>
                        <tr>
                            <td>
                               <b> Tiempo : </b>{{$membership->duration_time}} {{$membership->getDurationMode($membership->duration_mode)}}
                            </td>
                        </tr>
                       
                        <tr>
                            <td>
                               <b> Registro de actividades
                            </td>
                        </tr>
                        <tr>
                            <td>
                            Incluye:
                            <ul>
                                <li>Noticias sobre nuestras candidatas</li>
                                <li>Podrás votar online por tu candidata favorita. Tu votación diaria equivaldrá a 3 puntos.</li>
                                <li>Acceso a nuestras promociones o sorteos durante todo un año.</li>
                                <li>Un porcentaje del valor de la suscripción premium se donará a Junior Foundation: niños con cáncer.</li>
                            </ul>
                        </tr>
                    </table>
                </div>
                @if (!Auth::user()->client->current_membership() || !(Auth::user()->client->current_membership()->membership_id ==  $membership->id) )
                    <div class="panel-footer panel-footer-payments">
                        <button type="button" class="btn btn-sm btn-success pay-membership-with-stripe" data-email="{{Auth::user()->email}}" data-amount="{{ (int) $membership->price.'00'}}" data-membership="{{$membership->id}}" data-description="Pago de Membresia {{$membership->name}}" role="button"> <i class="fa fa-credit-card"></i> Usar Tarjeta</button>
                        <form action="{{ route('website.paypal.subscribe') }}" method="post" style="display: inline">
                            {{ csrf_field() }}
                            <input type="hidden" name="paypal_email" value="{{ Auth::user()->email }}">
                            <input type="hidden" name="paypal_membership_id" value="{{ $membership->id }}">
                            <input type="hidden" name="paypal_membership_name" value="{{ $membership->name }}">
                            <input type="hidden" name="paypal_membership_description" value="Pago de membresía {{ $membership->name }}">
                            <input type="hidden" name="paypal_membership_amount" value="{{ $membership->price }}">
                            <button type="submit" class="btn  btn-sm btn-success" role="button" title="Usar Paypal"><i class="fa fa-paypal"></i> Usar Paypal</button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    @endforeach
</div>

<div class="col-md-4">
    <p class="text-justify">Este año la organización permitirá que una de las candidatas entre
    directamente al top 12 en el evento final. Todos podrán votar pero
    deben estar suscritos a nuestra pagina web para acceder a las
    votaciones online. Hay dos tipos de suscripciones:
    </p>
    <p class="text-primary"><strong>Suscripción Gratuita</strong></p>
    <p class="text-justify">
    Cada usuario podrá votar una sola vez al día, es decir cada 24 horas.
    En este tipo de suscripción tu votación diaria equivale a 1 punto.    
    </p>
    <p class="text-success"><strong>Suscripción Premium</strong></p>
    <p class="text-justify">
    Si quieres que tu candidata favorita esté mas cerca de la corona
    internacional, tienes la opción de suscribirte en categoría premium, lo
    cual te permitirá votar una sola vez al día, es decir cada 24 horas,
    pero tu votación diaria equivaldrá a 3 puntos.
    </p>
    <p><strong>La candidata que acumule mas puntos, entrará directamente al top 12.</strong></p>
</div>

{{-- the magic form --}}
<form id="membeship-form" action="{{ route('website.stripe.subscribe') }}" method="POST" style="visibility: hidden;">
    {{ csrf_field() }}
    <input type="hidden" id="membership-id" name="membership_id" value="">
    <input type="hidden" id="amount" name="amount" value="">
    <input type="hidden" id="stripe-token" name="stripeToken" value="">
</form>
