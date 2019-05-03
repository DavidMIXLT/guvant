@extends('layouts.base')

@section('title','Productos')

@section('subtitle') Gestion de usuarios
@endsection



@section('header')
<script src="{{asset('js/modalsCRUD.js')}}"></script>
<script src="{{asset('js/filter.js')}}"></script>
<script src="{{asset('js/libraries/alertify.min.js')}}"></script>
<link rel="stylesheet" href="{{ asset('css/alertify.css')}}">
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection



@section('content')


<br /> {{-- Botones con las opciones --}}
<div class="d-flex ButtonBar mb-4">
    <button name="Create" class="btn m-1">Crear</button>

</div>


{{-- INICIO - Tabla productos --}}

<div class="table-responsive">
    <table class="table" id="productTable">
        <thead>
            <tr>
                <th scope="col">
                    <div class="spinner-border invisible" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </th>
                <th scope="col" id="id">Nombre de usuario</th>
                <th scope="col" id="name">rol</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
    @include('users.layouts.tablerow',["product" => $user])
            @endforeach
        </tbody>
    </table>
</div>
    @include("layouts.actions") {{-- Paginacion --}}
<div class="container pagination">
    @include('layouts.pagination',['object' => $users])
</div>
@endsection