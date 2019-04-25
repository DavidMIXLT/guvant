@extends('layouts.base') 
@section('title','Productos') 
@section('subtitle') Gestion de Platos
@endsection
 
@section('header')
<script src="{{asset('js/modalsCRUD.js')}}"></script>
<script src="{{asset('js/sortTable.js')}}"></script>
<script src="{{asset('js/plates/plates.js')}}"></script>
<script src="{{asset('js/libraries/alertify.min.js')}}"></script>
<link rel="stylesheet" href="{{ asset('css/alertify.css')}}">
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
 
@section('content')
<div class="d-flex ButtonBar mb-4">
<button name="Create" class="btn m-1">@lang('plates.createPlate')</button>
</div>

<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">
        <div class="spinner-border invisible" role="status">
          <span class="sr-only">@lang('plates.loading')</span>
        </div>
      </th>
      <th scope="col">ID</th>
      <th scope="col">@lang('plates.name')</th>
      <th scope="col">@lang('plates.description')</th>
      <th scope="col">@lang('plates.ingredients')</th>
      <th scope="col">@lang('plates.actions')</th>
    </tr>
  </thead>
  <tbody>

    @foreach ($plates as $plate)
  @include('plates.layouts.tablerow',["plate" => $plate]) @endforeach

  </tbody>
</table>
<div class="container pagination">
  @include('layouts.pagination',['object' => $plates])
</div>
  @include("layouts.actions")
@endsection