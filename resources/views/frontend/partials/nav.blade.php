<nav class="navbar navbar-inverse navbar-fixed-top navbar-main">
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
                <li class="@if(Request::path() == '/') active @endif"><a href="{{ route('website.home') }}">Candidatas</a></li>
                {{-- <li >
                    <a href="{{ route('website.account') }}" title="Comprar tickets" @if(Auth::user()->client->current_membership())  class="btn btn-update-membership-or-buy" @endif alt="Comprar tickets">Comprar Tickets</a>
                </li > --}}
                @if (!Auth::user()->client->current_membership())
                    <li>
                        <a href="{{ route('website.account') }}" title="Actualizar membresía" alt="Actualizar membresía">Actualice su membresía</a>
                    </li>
                @endif
                <li>
                    <a href="{{ route('apply.requirements') }}" class="btn btn-update-membership-or-buy"  alt="Postulese como candidata" title="Postulese como candidata"> Postulese!</a>
                </li>
            @endif
           

        </ul>

        @if (!Auth::user())
            {{-- <ul class="nav navbar-nav navbar-right">
                <li><a href="{{ route('client.show.login') }}">Entrar</a></li>
                <li><a href="{{ route('client.show.register') }}">Registrarse</a></li>
            </ul> --}}
        @else
             <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        {{ Auth::user()->name }} {{ Auth::user()->last_name }}<span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu" role="menu">
                        @if (Auth::user()->is_admin)
                            <li>
                                <a href="{{ route('dashboard') }}" title="Mi Cuenta">Ir a Administración</a>
                            </li>
                        @else 
                            <li>
                                <a href="{{ route('website.account') }}" title="Mi Cuenta">Mi Cuenta</a>
                            </li>
                        @endif
                        <li>
                            <a href="{{ url('auth/logout') }}"
                                onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                                Salir
                            </a>

                            <form id="logout-form" action="{{ url('auth/logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        @endif
    </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>