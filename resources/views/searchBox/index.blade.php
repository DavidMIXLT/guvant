@extends('layouts.base')
@section('title','Productos')
@section('subtitle') Gestion de Categorias
@endsection

@section('header')
<script src="{{asset('js/modalsCRUD.js')}}"></script>
<script src="{{asset('js/category.js')}}"></script>
<script src="{{asset('js/sortTable.js')}}"></script>
<script src="{{asset('js/libraries/alertify.min.js')}}"></script>
<link rel="stylesheet" href="{{ asset('css/alertify.css')}}">
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
<div class="container">
  <h1>Resultados de la busqueda <b>"{{$search}}"</b> </h1>
  <div class="row">
    @foreach ($products as $product)
    <div class="col-sm">
      <div class="card ml-2 mt-2" style="width: 18rem;">
        <div class="card-body">
          <h5 class="card-title">Producto: {{$product->name}}</h5>
          <p class="card-text">{{$product->description}}
          </p>
          <a href="{{route('products.index')}}" class="btn btn-primary">Mostrar</a>
        </div>
      </div>
    </div>
    @endforeach
    @foreach ($plates as $plate)
    <div class="col-sm">
      <div class="card ml-2 mt-2" style="width: 18rem;">
        <div class="card-body">
          <h5 class="card-title">Plato: {{$plate->name}}</h5>
          <p class="card-text">{{$plate->description}}
          </p>
          <a href="{{route('plates.index')}}" class="btn btn-primary">Mostrar</a>
        </div>
      </div>
    </div>
    @endforeach
    @foreach ($plates as $plate)
    <div class="col-sm">
      <div class="card ml-2 mt-2" style="width: 18rem;">
        <div class="card-body">
          <h5 class="card-title">Menu: {{$plate->name}}</h5>
     
          <a href="{{route('plates.index')}}" class="btn btn-primary">Mostrar</a>
        </div>
      </div>
    </div>
    @endforeach
  </div>
</div>

@endsection