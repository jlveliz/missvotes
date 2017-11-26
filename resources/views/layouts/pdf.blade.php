<html>
<head>
  <style>
    @page { margin: 62px 0px;}
    header { position: fixed; top: -60px; left: 0px; right: 0px; background-color: #F2F4F6; height: 100px; text-align: center;}
    footer { position: fixed; bottom: -60px; left: 0px; right: 0px; background-color: #F2F4F6; height: 50px;text-align: center; }
    main { margin-top: 70px; padding: 0px 15px }
    p { page-break-after: always; }
    p:last-child { page-break-after: never; }
    .title-report { font-weight: bold; font-size: 20px  }
    table { border: 1px solid #cdcdcd; width: 100%;  border-spacing: 0px; border-collapse: separate; }
    th, td { font-size: 15px; border: 1px  solid;  }
    td { padding: 0px }
    th { text-align: center  }
  </style>
</head>
<body>
  <header>
       <img src="{{ asset('public/images/logo_square.png') }}" alt="{{ config('app.name') }}" title="{{ config('app.name') }}">
  </header>
  <main>
    @yield('body')
    {{-- <p></p>
    <p></p> --}}
  </main>
  <footer>
      <span style="text-align: center;display: block;"> &copy; {{ date('Y') }}
       {{ config('app.name') }}. {{ trans('email.right_reserved')}}.
    </span>
  </footer>
</body>
</html>