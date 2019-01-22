@extends('layouts.base') 
@section('title','Productos') 
@section('subtitle') Gestion de productos
@endsection

@section('header')
        <script src="{{asset('js/products.js')}}"></script>
        <script src="{{asset('js/sortTable.js')}}"></script>
@endsection

@section('content')


<br/>
<a href="{{route('products.create')}}" class="btn btn-primary">@lang('products/productsIndex.createProduct')</a>
<br/>
<!-- Inicio mensajes de Alertas -->
<br/> @if (isset($alertaCreado)) @if ($alertaCreado)
<div class="alert alert-success" role="alert">
    @lang('messages.productCreated')
</div>
@else
<div class="alert alert-danger" role="alert">
    @lang('messages.productError')
</div>
@endif @endif
<div class="table-responsive">
<table class="table" id="productTable">
    <thead class="thead-dark">
        <tr>
            <th scope="col"></th>
            <th scope="col" id="idRow">@lang('products/products.id') ↕</th>
            <th scope="col" id="nameRow">@lang('products/products.name') ↕</th>
            <th scope="col" id="descriptionRow">@lang('products/products.description') ↕</th>
            <th scope="col" id="stockRow">@lang('products/products.stock') ↕</th>
            <th scope="col" id="dateRow">@lang('products/products.dateCreated') ↕</th>
            <th scope="col">@lang('products/productsIndex.actions') </th>
        </tr>
    </thead>
    <tbody>


        @foreach ($products as $product)
        <tr>
            <td>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="checkBoxAction" value="{{$product->id}}">
                    <label class="form-check-label" for="checkBoxAction"></label>
                </div>
            </td>
            <td><a href="{{route('products.edit',$product->id)}}">{{$product->id}}</td>
            <td><a href="{{route('products.edit',$product->id)}}">{{$product->name}}</a></td>
            <td><a href="{{route('products.edit',$product->id)}}">{{ substr($product->description, 0, 60)}}</a></td>
            <td><a href="{{route('products.edit',$product->id)}}">{{$product->stock}}</a></td>
            <td><a href="{{route('products.edit',$product->id)}}">{{$product->created_at}}</a></td>

            <td>
                <div class="container">
                <form class=" d-inline" action="{{route('products.destroy',$product->id)}}" method="POST">
                    @csrf @method('DELETE')
                    <button name="submit" type="submit" class="btn btn-danger">@lang('products/productsIndex.delete')</button>
                </form>
            <a class="btn btn-primary"  role="button" href="{{route("products.edit",$product->id)}}">@lang('products/productsIndex.edit')</a>
            </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>

<form id="massiveAction" action="{{route('products.destroy',-1)}}" method="POST">
    @csrf @method('DELETE')
    <input type="hidden" id="checkBoxList" name="productsToDelete" value="">
</form>
<div class="dropdown">
    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
        aria-expanded="false">
        @lang('products/productsIndex.Massiveactions')
        </button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <button type="button" class=" dropdown-item" id="deleteButton">@lang('products/productsIndex.deleteSelectedItems')</button>
        <button type="button" class=" dropdown-item" id="editButton">Editar</button>


    </div>
</div>
@endsection