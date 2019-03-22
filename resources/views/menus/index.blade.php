@extends('layouts.base') 
@section('title','Productos') 
@section('subtitle') Gestion de Menus
@endsection
 
@section('header')
<script src="{{asset('js/modalsCRUD.js')}}"></script>
<script src="{{asset('js/sortTable.js')}}"></script>
<script src="{{asset('js/menus.js')}}"></script>
<script src="{{asset('js/libraries/alertify.min.js')}}"></script>
<link rel="stylesheet" href="{{ asset('css/alertify.css')}}">
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
 
@section('content')
<div class="d-flex ButtonBar mb-4">
    <button name="Create" class="btn m-1">Crear Menu</button>
</div>
<table class="table">
    <thead class="thead-dark">
        <tr>
            <th scope="col">
                <div class="spinner-border invisible" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </th>
            <th scope="col">ID</th>
            <th scope="col">Nombre</th>
            <th scope="col">Precio</th>
            <th scope="col">Acciones</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($menus as $menu)
    @include('menus.layouts.tablerow',["menu" => $menu])
    @endforeach
    </tbody>
</table>



{{-- Paginacion --}}
<div class="container pagination">
    @include('layouts.pagination',['object' => $menus])
</div>
    @include("layouts.actions")
@endsection