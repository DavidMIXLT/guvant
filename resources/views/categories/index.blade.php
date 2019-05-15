@extends('layouts.base') 
@section('title','Productos') 
@section('subtitle')@lang('orders.categoryManagement') 
@endsection
 
@section('header')
<script src="{{asset('js/modalsCRUD.js')}}"></script>
<script src="{{asset('js/category.js')}}"></script>
<script src="{{asset('js/sortTable.js')}}"></script>
<script src="{{asset('js/libraries/alertify.min.js')}}"></script>
<link rel="stylesheet" href="{{ asset('css/alertify.css')}}">
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
 
@section('content')
<div class="d-flex ButtonBar mb-4">
  <button name="Create" class="btn m-1">@lang('orders.createCategory')</button>
</div>
<table class="table">
  <thead>
    <tr>
      <th scope="col">
        <div class="spinner-border invisible" role="status">
          <span class="sr-only">@lang('orders.loading')</span>
        </div>
      </th>
      <th scope="col">@lang('orders.id')</th>
      <th scope="col">@lang('orders.name')</th>
      <th scope="col">@lang('orders.action')</th>
    </tr>
  </thead>
  <tbody>
    @each('categories.layouts.tableRow', $categories, 'category')
  </tbody>
</table>

{{-- Paginacion --}}
<div class="container pagination">
  @include('layouts.pagination',['object' => $categories])
</div>
  @include("layouts.actions")
@endsection