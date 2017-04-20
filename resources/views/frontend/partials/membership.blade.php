<div class="col-md-8 col-xs-12">
    @if (!Auth::user()->client->current_membership())
        <div class="col-xs-12 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        @lang('membership.free_lbl') 
                            <br>
                                <b>(@lang('membership.act_membership_lbl'))</b>
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
                                <b>@lang('membership.lbl_membership_lbl'): </b> 1 @lang('membership.tm_membership_lbl')
                            </td>
                        </tr>
                        
                        <tr>
                            <td class="text-justify">
                            @lang('membership.includes_membership_lbl'):
                            <ul>
                                <li>@lang('membership.free_1_membership_lbl')</li>
                                <li>@lang('membership.free_2_membership_lbl')</li>
                                <li>@lang('membership.free_3_membership_lbl')</li>
                            </ul>
                            </td>
                        </tr>
                    </table>
                </div>
                @if (Auth::user()->client->current_membership())
                    <div class="panel-footer">
                        <a href="#" class="btn btn-success" role="button">@lang('membership.update_btn')</a>
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
                            <b>(@lang('membership.act_membership_lbl'))</b>
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
                               <b> @lang('membership.lbl_membership_lbl'): </b>{{$membership->duration_time}} @lang('membership.tm_membership_lbl')
                            </td>
                        </tr>

                        <tr>
                            <td class="text-justify">
                            @lang('membership.includes_membership_lbl'):
                            <ul>
                                <li>@lang('membership.prm_1_membership_lbl')</li>
                                <li>@lang('membership.prm_2_membership_lbl')</li>
                                <li>@lang('membership.prm_3_membership_lbl')</li>
                                <li>@lang('membership.prm_4_membership_lbl')</li>
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
    <p class="text-justify">@lang('membership.txt_data_1'):
    </p>
    <p class="text-primary"><strong>@lang('membership.free_sus')</strong></p>
    <p class="text-justify">
    @lang('membership.txt_free_sus')    
    </p>
    <p class="text-success"><strong>@lang('membership.prem_sus')</strong></p>
    <p class="text-justify">
    @lang('membership.txt_prem_sus')
    </p>
    <p><strong>@lang('membership.adi_txt')</strong></p>
</div>

{{-- the magic form --}}
<form id="membeship-form" action="{{ route('website.stripe.subscribe') }}" method="POST" style="visibility: hidden;">
    {{ csrf_field() }}
    <input type="hidden" id="membership-id" name="membership_id" value="">
    <input type="hidden" id="amount" name="amount" value="">
    <input type="hidden" id="stripe-token" name="stripeToken" value="">
</form>
