<html>
<head>
  <style>
    
  </style>
</head>
<body>
  <header>
      <h1>{{ config('app.name') }}</h1>
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