<nav class="navbar navbar-inverse navbar-fixed-top navbar-main">
    <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <a class="navbar-brand visible-xs navbar-app-mini" href="{{ route('website.home') }}">
            <img title="Miss Panamerican" alt="Miss Panamerican" src="{{ asset('public/images/queen-mini.png') }}" alt="">
        </a>
        <div class="navbar-brand hidden-xs navbar-app">
            <a href="{{ route('website.home') }}">
                <img class="img-responsive logo" class="logo" src="{{ asset('public/images/queen.png') }}" alt="Logo">
            </a>
        </div>
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        @if (!Auth::user())
            <ul class="nav navbar-nav navbar-right">
                <li><a data-toggle="modal" data-target="#login-modal" href="#">Entrar</a></li>
                <li><a data-toggle="modal" data-target="#register-modal" href="#">Registrarse</a></li>
            </ul>
        @else
             <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu" role="menu">
                        @if (Auth::user()->is_admin)
                            <li>
                                <a href="{{ url('backend/clients') }}" title="Mi Cuenta">Ir a Administración</a>
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