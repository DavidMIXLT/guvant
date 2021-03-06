@extends('layouts.base')
@section('title','Productos')
@section('subtitle')@lang('products.productManagement')
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


<br /> {{-- Botones con las opciones --}}
<div class="d-flex ButtonBar mb-4">
    <button name="Create" class="btn m-1">@lang('products/index.createProduct')</button>
    <div id="dropDown_CAT" class="dropdown m-1">
        <button class="btn btn-light dropdown-toggle" type="button" id="categories" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            @lang('products.categories')
        </button>
        <div id="dropDown_Items" class="dropdown-menu" aria-labelledby="categories">
            @foreach ($categories as $category)
            <div class="dropCat ml-2 custom-control custom-checkbox">
                <input name="categoryCheckBox" type="checkbox" class="custom-control-input" id="{{$category->id}}">
                <label class="custom-control-label" for="{{$category->id}}">{{$category->name}}</label>

            </div>
            @endforeach
            <button type="button" name="applyFilter"
                class="btn btn-primary float-right mt-3 mr-2 btn-info">@lang('products.applyFilter')</button>
        </div>
    </div>
</div>


{{-- INICIO - Tabla productos --}}

<div class="table-responsive">

    <table class="table" id="productTable">
        <thead>
            <tr>
                <th scope="col">
                    <div class="spinner-border invisible" role="status">
                        <span class="sr-only">@lang('products.loading')</span>
                    </div>
                </th>
                <th scope="col" id="id">@lang('products/index.id') ↕</th>
                <th scope="col" id="name">@lang('products/index.name') ↕</th>
                <th scope="col" id="description">@lang('products/index.description') ↕</th>
                <th scope="col" id="stock">@lang('products/index.stock') ↕</th>
                <th scope="col" id="date">@lang('products/index.dateCreated') ↕</th>
                <th scope="col">@lang('products/index.actions') </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
            @include('products.layouts.tablerow',["product" => $product,"categories" => $product->categories])
            @endforeach
        </tbody>
    </table>
</div>
@include("layouts.actions") {{-- Paginacion --}}
<div class="container pagination">
    @include('layouts.pagination',['object' => $products])
</div>
@endsection