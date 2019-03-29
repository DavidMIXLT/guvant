@extends('layouts.base') 
@section('title','Productos') 
@section('subtitle') Gestion de Pedidos
@endsection
 
@section('header')
<script src="{{asset("js/orders.js")}}"></script>
<script src="{{asset('js/modalsCRUD.js')}}"></script>
<script src="{{asset('js/libraries/alertify.min.js')}}"></script>
@endsection
 
@section('content')
<div class="d-flex ButtonBar mb-4">
   <button name="Create" class="btn m-1">Crear pedido</button>
</div>

@endsection