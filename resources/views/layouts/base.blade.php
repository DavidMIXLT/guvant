<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>A la carta ya - @yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/base.css')}}">
    <script src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
    @yield('header')
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
                        <a class="dropdown-item" href="{{route('entradaProducto')}}">Entrar pedidos</a>
                    </div>
                </div>
            </li>
        </ul>

    </nav>


    <!-- Fin Barra navegacion -->

    <!-- Inicio Contenido --><br/>
    <br/>
    <div class="container">
        <h1 class="m-b-5">@yield('subtitle')</h1><br> @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif @yield('content')
    </div>
    <!-- Fin Contenido -->

    
</body>

</html>