@extends('layouts.base') 
@section('title','Productos') 
@section('subtitle') Gestion de productos
@endsection
    
@section('header')
<script src="{{asset('js/modalsCRUD.js')}}"></script>
<script src="{{asset('js/products.js')}}"></script>
<script src="{{asset('js/sortTable.js')}}"></script>
<script src="{{asset('js/filter.js')}}"></script>
<script src="{{asset('js/libraries/alertify.min.js')}}"></script>
<link rel="stylesheet" href="{{ asset('css/alertify.css')}}">
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
 
@section('content')


<br/>

    {{--  Botones con las opciones  --}}
<div class="d-flex">
    <button name="Create" class="btn btn-success m-1">@lang('products/index.createProduct')</button>
    <div id="dropDown_CAT" class="dropdown m-1">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="categories" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">
              Categorias
            </button>
        <div id="dropDown_Items" class="dropdown-menu" aria-labelledby="categories">
            @foreach ($categories as $category)
            <div class="dropCat ml-2 custom-control custom-checkbox">
                <input name="categoryCheckBox" type="checkbox" class="custom-control-input" id="{{$category->id}}">
                <label class="custom-control-label" for="{{$category->id}}">{{$category->name}}</label>
                
            </div>
            @endforeach
            <button type="button" name="applyFilter" class="btn btn-primary float-right mt-3 mr-2">Aplicar Filtro</button>
        </div>
    </div>
</div>


      {{-- INICIO - Tabla productos  --}}

<div class="table-responsive">
    <table class="table" id="productTable">
        <thead class="thead-dark">
            <tr>
                <th scope="col">
                    <div class="spinner-border invisible" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </th>
                <th scope="col" id="idRow">@lang('products/index.id') ↕</th>
                <th scope="col" id="nameRow">@lang('products/index.name') ↕</th>
                <th scope="col" id="descriptionRow">@lang('products/index.description') ↕</th>
                <th scope="col" id="stockRow">@lang('products/index.stock') ↕</th>
                <th scope="col" id="dateRow">@lang('products/index.dateCreated') ↕</th>
                <th scope="col">@lang('products/index.actions') </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                 @include('products.layouts.tablerow',["product" => $product,"categories" => $product->categories])
            @endforeach
        </tbody>
    </table>
    
   {{-- Paginacion  --}}
    <div class="container pagination">
        @include('layouts.pagination',['object' => $products])
    </div>
 
</div>
    @include("layouts.actions")
@endsection