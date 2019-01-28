@extends('layouts.base') 
@section('title','Productos') 
@section('subtitle') Gestion de productos
@endsection
 
@section('header')
<script src="{{asset('js/products.js')}}"></script>
<script src="{{asset('js/sortTable.js')}}"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
 
@section('content')


<br/>
<a href="{{route('products.create')}}" class="btn btn-primary">@lang('products/productsIndex.createProduct')</a>
<br/>
<!-- Inicio mensajes de Alertas -->
<br/>

<div class="table-responsive">
    <table class="table" id="productTable">
        <thead class="thead-dark">
            <tr>
                <th scope="col">
                    <div class="spinner-border invisible" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>

                </th>
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
                        <input type="checkbox" class="form-check-input" name="checkBoxActionDelete" value="{{$product->id}}">
                        <label class="form-check-label" for="checkBoxAction"></label>
                    </div>
                </td>
                <td><a class="ProductID" href="{{route('products.edit',$product->id)}}">{{$product->id}}</td>
                <td><a class="ProductName" href="{{route('products.edit',$product->id)}}">{{$product->name}}</a></td>
                <td><a class="ProductDescription" href="{{route('products.edit',$product->id)}}">{{substr($product->description, 0, 60)}}</a></td>
                <td><a class="ProductStock" href="{{route('products.edit',$product->id)}}">{{$product->stock}}</a></td>
                <td><a href="{{route('products.edit',$product->id)}}">{{$product->created_at}}</a></td>

                <td>
                    <div class="container">
                        <button name="Delete" class="btn btn-danger ">@lang('products/productsIndex.delete')</button>
                        <button name="Edit" class="btn btn-primary ">@lang('products/productsIndex.edit')</button>

                        
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="dropdown">
    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
        aria-expanded="false">
        @lang('products/productsIndex.Massiveactions')
        </button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <button type="button" class=" dropdown-item" id="SelectAll">Seleccionar Todo</button>
        <button type="button" class=" dropdown-item" id="MassiveDeleteButton">@lang('products/productsIndex.deleteSelectedItems')</button>
        <button type="button" class=" dropdown-item" id="editButton">Editar</button>
    

    </div>
</div>
@endsection