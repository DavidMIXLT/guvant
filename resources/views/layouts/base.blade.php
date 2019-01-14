<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>A la carta ya - @yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/base.css')}}">
</head>
<body>

       <!-- Inicio Barra navegacion -->
       
    <nav class="navbar navbar-dark bg-primary">
        <a class="navbar-brand" href="#">A la carta Ya</a>
        <form class="form-inline my-2 my-lg-0">
         <input class="form-control mr-sm-2" type="search" placeholder="Buscar" aria-label="Search">
        <button class="boton btn" type="submit">Buscar</button>
    </form>
    </nav>
   <!-- Fin Barra navegacion -->

    <!-- Inicio Contenido -->
        <div class="container">
            @yield('content')
        </div>
   <!-- Fin Contenido -->

   <!-- Inicio footer -->
    <footer class="page-footer font-small blue ">
        <div class="footer-copyright text-center py-3 footerBase">© 2018 Copyright:
            <p>A la carta ya Guvant 2019</p>
        </div>
    </footer>
     <!-- Fin footer -->
</body>
</html>