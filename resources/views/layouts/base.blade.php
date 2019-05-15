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
                <form method="POST" action="{{route('searchBox')}}" class="form-inline pt-2">
                    @csrf
                    <input name="search" class="form-control" type="search" placeholder="Buscar" aria-label="Search">
                </form>
            </div>
            @auth

            <!-- Menu izquierda -->
            <ul class="list-unstyled components">
                @if (Request::user()->rol = 1)
                <li class="{{ Request::routeIs('products.index') ? 'active' : '' }}">
                    <a href="{{route('products.index')}}" aria-expanded="false">@lang('orders.products')</a>
                </li>
                <li class="{{ Request::routeIs('orders.index') ? 'active' : '' }}">
                    <a class="nav-link" href="{{route('orders.index')}}">@lang('orders.orders')</a>
                </li>
                <li class="{{ Request::routeIs('menus.index') ? 'active' : '' }}">
                    <a href="{{route('menus.index')}}" aria-expanded="false">@lang('orders.menu')</a>
                </li>
                <li class="{{ Request::routeIs('plates.index') ? 'active' : '' }}">
                    <a href="{{route('plates.index')}}">@lang('orders.plates')</a>
                </li>
                <li class="{{ Request::routeIs('categories.index') ? 'active' : '' }}">
                    <a href="{{route('categories.index')}}">@lang('orders.category')</a>
                </li>
                <li class="{{ Request::routeIs('users.index') ? 'active' : '' }}">
                    <a href="{{route('users.index')}}">@lang('orders.user')</a>
                </li>
                @endif

                @if (Request::user()->rol >= 2)
                <li class="{{ Request::routeIs('products.index') ? 'active' : '' }}">
                    <a href="{{route('products.index')}}" aria-expanded="false">@lang('orders.products')</a>
                </li>
                <li class="{{ Request::routeIs('orders.index') ? 'active' : '' }}">
                    <a class="nav-link" href="{{route('orders.index')}}">@lang('orders.orders')</a>
                </li>
                <li class="{{ Request::routeIs('menus.index') ? 'active' : '' }}">
                    <a href="{{route('menus.index')}}" aria-expanded="false">@lang('orders.menu')</a>
                </li>
                <li class="{{ Request::routeIs('plates.index') ? 'active' : '' }}">
                    <a href="{{route('plates.index')}}">@lang('orders.plates')</a>
                </li>
  
                </li>
                @endif
            </ul>
            @endauth

            @guest
            <ul class="list-unstyled components">
                <li class="{{ Request::routeIs('register') ? 'active' : '' }}">
                    <a href="{{route('register')}}" aria-expanded="false">@lang('orders.register')</a>
                </li>
                <li class="{{ Request::routeIs('login') ? 'active' : '' }}">
                    <a href="{{route('login')}}" aria-expanded="false">@lang('orders.logIn')</a>
                </li>
            </ul>
            @endguest
            <ul class="list-unstyled CTAs">

            </ul>
        </nav>


        <div id="content">
            <!-- TOP BAR -->
            <nav class="navbar navbar-expand-lg">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="btn btn-primary">
                        &#9776;

                    </button>
                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                        <span>&#9776;</span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto">
                            <!-- Authentication Links -->
                            @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                            @endif @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name}} ({{ Auth::user()->roles()->first()->description}}) <span
                                        class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>

            <!-- Contenido -->
            @yield('content')
        </div>

</body>

</html>