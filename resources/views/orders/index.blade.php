@extends('layouts.base')

@section('title','Productos')

@section('subtitle') Gestion de Pedidos
@endsection



@section('header')
<script src="{{asset('js/orders.js')}}"></script>
<script src="{{asset('js/modalsCRUD.js')}}"></script>
<script src="{{asset('js/libraries/alertify.min.js')}}"></script>
<link rel="stylesheet" href="{{ asset('css/alertify.css')}}">t>
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection



@section('content')
<div class="d-flex ButtonBar mb-4">
   <button name="Create" class="btn m-1">Crear pedido</button>
</div>
<div>
   <div class="table-responsive">
      <table class="table">
         <thead>
            <tr>
               <th scope="col">
                  <div class="spinner-border invisible" role="status">
                     <span class="sr-only">Loading...</span>
                  </div>
               </th>
               <th scope="col">ID</th>
               <th scope="col">Nombre</th>
               <th scope="col">Fecha creado</th>
               <th scope="col">Acciones</th>
            </tr>
         </thead>
         <tbody>
            @each('orders.layouts.tableRow', $orders, 'order')
         </tbody>
      </table>
   </div>
      <div class="container pagination">
   @include('layouts.pagination',['object' => $orders])
      </div>
   @include("layouts.actions")
   </div>
</div>
@endsection