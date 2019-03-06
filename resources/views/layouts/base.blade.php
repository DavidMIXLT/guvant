<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>A la carta ya - @yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/base.css')}}">

    <script src="{{asset('js/libraries/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('js/libraries/bootstrap.bundle.min.js')}}"></script>
    @yield('header')
</head>

<body>


    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <img class="img-fluid" src="{{asset('img/logo.png')}}">
                <form class="form-inline pt-2">
                    <input class="form-control" type="search" placeholder="Search" aria-label="Search">
                </form>
            </div>



            <ul class="list-unstyled components">

                <li class="active">
                    <a href="{{route('products.index')}}" aria-expanded="false">Productos</a>

                </li>
                <li>
                    <a href="#">About</a>
                </li>
                <li>
                    <a href="{{route('menus.index')}}" aria-expanded="false" class="dropdown-toggle">Menus</a>

                </li>
                <li>
                    <a href="{{route('plates.index')}}">Platos</a>
                </li>
                <li>
                    <a href="{{route('categories.index')}}">Categorias</a>
                </li>
            </ul>

            <ul class="list-unstyled CTAs">
                <li>
                    <a href="https://bootstrapious.com/tutorial/files/sidebar.zip" class="download">Download source</a>
                </li>
                <li>
                    <a href="https://bootstrapious.com/p/bootstrap-sidebar" class="article">Back to article</a>
                </li>
            </ul>
        </nav>

        <!-- Page Content  -->
        <div id="content">

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="btn btn-info">
                                <i class="fas fa-align-left"></i>
                                <span>Toggle Sidebar</span>
                            </button>
                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                <i class="fas fa-align-justify"></i>
                            </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto">
                            <li class="nav-item active">
                                <a class="nav-link" href="#">Page</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Page</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Page</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Page</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <h1 class="m-b-5">@yield('subtitle')</h1>
            @yield('content')
        </div>

</body>

</html>