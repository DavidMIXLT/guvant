@extends('layouts.base') 
@section('title','Productos') 
@section('subtitle') Gestion de Platos
@endsection
 
@section('header')
<script src="{{asset('js/modalsCRUD.js')}}"></script>
<script src="{{asset('js/sortTable.js')}}"></script>
<script src="{{asset('js/plates/plates.js')}}"></script>
<script src="{{asset('js/alertify.min.js')}}"></script>
<link rel="stylesheet" href="{{ asset('css/alertify.css')}}">
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
 
@section('content')
<button name="Create" type="button" class="btn btn-success m-1">Crear Plato</button>
<table class="table">
    <thead class="thead-dark">
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Nombre</th>
        <th scope="col">Descripcion</th>
        <th scope="col">Ingredientes</th>
        <th scope="col">Acciones</th>
      </tr>
    </thead>
    <tbody>

      @foreach ($plates as $plate)
      @include('plates.layouts.tablerow',["plate" => $plate])
      @endforeach
      
    </tbody>
  </table>


@endsection

