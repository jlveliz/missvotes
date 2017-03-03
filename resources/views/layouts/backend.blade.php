<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href=" {{asset('public/css/app.css')}} " rel="stylesheet">
    <link href=" {{asset('public/css/backend.css')}} " rel="stylesheet">
    <link href=" {{asset('/public/css/font-awesome.min.css')}} " rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/js/datatables/jquery.dataTables.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('public/js/datatables/buttons.bootstrap.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('public/js/datatables/fixedHeader.bootstrap.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('public/js/datatables/responsive.bootstrap.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('public/js/datatables/scroller.bootstrap.min.css') }}" />
    @yield('css')

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    @if (Auth::user()) 
                       <ul class="nav navbar-nav">
                            <li class="@if(Request::path() == 'backend/misses') active @endif"><a href="{{ route('misses.index') }}">Candidatas <span class="sr-only">(current)</span></a></li>
                            <li class="@if(Request::path() == 'backend/clients') active @endif"><a href="{{ route('clients.index') }}">Clientes <span class="sr-only">(current)</span></a></li>
                            <li class="@if(Request::path() == 'backend/users') active @endif"><a href="{{ route('users.index') }}">Usuarios <span class="sr-only">(current)</span></a></li>
                        </ul>
                    @endif

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::user())
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ url('backend/logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Salir
                                        </a>

                                        <form id="logout-form" action="{{ url('backend/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container">
            <div id="panel-container">
                <div class="row">
                    <div class="col-md-12">
                        @yield('content')    
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Scripts -->
    <script src="{{asset('public/js/app.js')}} "></script>
    <script src="{{ asset('public/js/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('public/js/datatables/dataTables.bootstrap.js') }}"></script>
    <script src="{{ asset('public/js/datatables/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('public/js/datatables/buttons.bootstrap.min.js') }}"></script>
    <script src="{{ asset('public/js/datatables/jszip.min.js') }}"></script>
    <script src="{{ asset('public/js/datatables/pdfmake.min.js') }}"></script>
    <script src="{{ asset('public/js/datatables/vfs_fonts.js') }}"></script>
    <script src="{{ asset('public/js/datatables/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('public/js/datatables/buttons.print.min.js') }}"></script>
    <script src="{{ asset('public/js/datatables/dataTables.fixedHeader.min.js') }}"></script>
    <script src="{{ asset('public/js/datatables/dataTables.keyTable.min.js') }}"></script>
    <script src="{{ asset('public/js/datatables/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('public/js/datatables/responsive.bootstrap.min.js') }}"></script>
    <script src="{{ asset('public/js/datatables/dataTables.scroller.min.js') }}"></script>
    @yield('js')
</body>
</html>
