@extends('layouts.base') 
@section('title','Pedidos Entrantes') 
@section('subtitle')
<h1>Entrar pedidos</h1>
@endsection
 
@section('header')
<script src="{{asset('js/incomingOrders.js')}}"></script>
<script src="{{asset('js/sortTable.js')}}"></script>
@endsection
 
@section('content')
<table class="table" id="productTable">
    <thead class="thead-dark">
        <tr>
            <th scope="col" id="idRow">@lang('products/products.id') ↕</th>
            <th scope="col" id="nameRow">@lang('products/products.name') ↕</th>
            <th scope="col" >Introduce el nuevo stock</th>
            <th scope="col" id="stockRow"> Total de stock</th>
        </tr>
    </thead>
    <tbody>

 
        @foreach ($products as $product)

        <tr>

            <td><a href="{{route('products.edit',$product->id)}}">{{$product->id}}</td>
            <td><a href="{{route('products.edit',$product->id)}}">{{$product->name}}</a></td>
            <td ><input class="inputStock" type="text"></td>
            <td class="stock" stock="{{$product->stock}}">{{$product->stock}}</td>


        </tr>
        @endforeach
    </tbody>
</table>
<form id="updateProductStockTable" method="POST" action="{{route('products.update',1)}}">
    @method('PUT')
    @csrf
    <input name="stockActualizar" type="hidden" id="hiddenValue" value="">
</form>

<button id="updateButton" type="button" class="btn btn-primary">Actualiza stock</button>
@endsection