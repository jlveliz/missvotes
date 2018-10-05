<nav class="navbar @if(Request::path() == '/') navbar-inverse navbar-inverse-index  @else navbar-inverse @endif navbar-main">
    <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

        <ul class="nav navbar-nav">
            @if (Auth::user() && !Auth::user()->is_admin)
                {{-- <li class="@if(Request::path() == '/') active @endif"><a href="{{ route('website.home') }}">Candidatas</a></li> --}}
                @if ($existCasting)
                   @can('postulate',Auth::user())
                    <li>
                        <a href="https://www.misspanamericaninternational.com" class="btn"  alt="{{ trans('app.apply_now') }}" title="{{ trans('app.apply_now') }}"> {{ trans('app.home') }}</a>
                    </li>
                        {{-- expr --}}
                   
                    <li>
                        <a href="{{ route('apply.aplicationProcess') }}" class="btn btn-update-membership-or-buy"  alt="{{ trans('app.apply_now') }}" title="{{ trans('app.apply_now') }}"> {{ trans('app.apply_now') }}</a>
                    </li>
                    @endcan
               {{--  <li style="margin-left: 2px">
                    <a href="{{ route('list.buy.ticket') }}" class="btn btn-update-membership-or-buy"  alt="{{ trans('app.win_travel') }}" title="{{ trans('app.win_travel') }}"> {{ trans('app.win_travel') }}</a>
                </li> --}}
               
                @endif
            @endif
           

        </ul>

        @if (!Auth::user())
            {{-- <ul class="nav navbar-nav navbar-right">
                <li><a href="{{ route('client.show.login') }}">{{ trans('app.login') }}</a></li>
                <li><a href="{{ route('client.show.register') }}">{{ trans('app.register') }}</a></li>
            </ul> --}}
        @else
             <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                
                @if (Auth::user()->is_admin)
                    <li>
                        <a href="{{ route('dashboard') }}" title="{{ trans('app.go_administration') }}">{{ trans('app.go_administration') }}</a>
                    </li>
                @else 
                    <li>
                        <a href="{{ route('website.account') }}" title="{{ trans('app.my_account') }}">{{ trans('app.my_account') }}</a>
                    </li>
                @endif

                <li>
                    <a href="{{ url('auth/logout') }}"
                        onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                        {{ trans('app.logout') }}
                    </a>

                    <form id="logout-form" action="{{ url('auth/logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>

                @if (App::isLocale('en'))
                    <li>
                        <form action="{{ route('website.locale') }}">
                            {{ csrf_field() }}
                            <input type="hidden" name="lang" value="es">
                            <button  type="submit" class="btn btn-update-membership-or-buy" > Spanish</button>                            
                        </form>
                    </li>
                @else
                    <li>
                        <form action="{{ route('website.locale') }}">
                            {{ csrf_field() }}
                            <input type="hidden" name="lang" value="en">
                            <button  type="submit" class="btn btn-update-membership-or-buy"> Inglés</button>                 
                        </form>
                    </li>
                @endif

               {{--  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        {{ Auth::user()->name }} {{ Auth::user()->last_name }}<span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu" role="menu">
                      
                        
                    </ul>
                </li> --}}
            </ul>
        @endif
    </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>