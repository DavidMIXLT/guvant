<!DOCTYPE html>
<html>

<head>
    <!-- TO DO Cargar los scripts desde local del boostrap -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>A la carta ya - @yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS"
        crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/base.css')}}">
    <script src="{{asset('js/products.js')}}"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
</head>

<body>

    <!-- Inicio Barra navegacion -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary text-warning">
        <a class="navbar-brand" href="{{route('panel')}}">AlaCartaYa</a>
        <ul class="navbar-nav mr-auto">
            <li class="navbar-nav">
                <a class="nav-link" href="{{route('panel')}}">Panel</a>
            </li>
            <li class="nav-item dropdown">
                <div class="btn-group nav-item">
                    <a href="{{route('products.index')}}" class="nav-link ">Gestion de productos</a>
                    <button type="button" class="btn  dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <span class="sr-only">Toggle Dropdown</span>
                            </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{route('products.create')}}">Crear producto</a>
                        <a class="dropdown-item" href="{{route('products.index')}}">Productos</a>
                    </div>
                </div>
            </li>
        </ul>

    </nav>


    <!-- Fin Barra navegacion -->

    <!-- Inicio Contenido --><br/>
    <br/>
    <div class="container">
        <h1 class="m-b-5">@yield('subtitle')</h1><br>
         @yield('content')
    </div>
    <!-- Fin Contenido -->

    <!-- Inicio footer -->

    <!-- Fin footer -->
</body>

</html>