<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>A la carta ya</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/cover/">

    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/base.css')}}">
    <script src="{{asset('js/libraries/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('js/libraries/bootstrap.bundle.min.js')}}"></script>

    <!-- Custom styles for this template -->
    <link href="{{ asset('css/cover.css')}}" rel="stylesheet">
  </head>

  <body class="text-center">

    <div class="cover-container d-flex h-100 p-3 mx-auto flex-column">
      <header class="masthead mb-auto">
        <div class="inner">
          <h3 class="masthead-brand">A la carta ya</h3>
          <nav class="nav nav-masthead justify-content-center">
            <a class="nav-link active" href="#">@lang('Users.Start')</a>
          <a class="nav-link" href="{{route('login')}}">@lang('Users.log')</a>
          <a class="nav-link" href="{{route('register')}}">@lang('Users.checkIn')</a>
          </nav>
        </div>
      </header>

      <main role="main" class="inner cover">
        <h1 class="cover-heading">A la carta ya</h1>
        <p class="lead">>@lang('Users.appilcationYourRestaurant')</p>
        <p class="lead">
          <a href="#" class="btn btn-lg btn-secondary">@lang('Users.knowMore')</a>
        </p>
      </main>

      <footer class="mastfoot mt-auto">
        <div class="inner">
          <p>@lang('Users.proyectM12')Proyecte M12</p>
        </div>
      </footer>
    </div>


  </body>
</html>
