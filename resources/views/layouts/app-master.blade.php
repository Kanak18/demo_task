<!doctype html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.87.0">
    <title>Demo Task</title>

    <!-- Bootstrap core CSS -->
    <link href="{!! url('https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.2/css/bootstrap.min.css') !!}" rel="stylesheet">



    <link href="{!! url('https://use.fontawesome.com/releases/v5.3.1/css/all.css') !!}" rel="stylesheet">    





    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="{!! url('assets/css/app.css') !!}" rel="stylesheet">
</head>
<body>
    
    @include('layouts.partials.navbar')

    <main class="container">
        @yield('content')
    </main>

    
    
    <script src="{!! url('https://code.jquery.com/jquery-3.7.0.min.js') !!}" defer></script>
      <script src="{!! url('assets/bootstrap/js/bootstrap.min.js') !!}" defer></script>
      <script src = "{!! url('https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js') !!}">
  </body>
</html>