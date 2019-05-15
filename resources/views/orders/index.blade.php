@extends('layouts.base')

@section('title','Productos')

@section('subtitle')@lang('orders.ordersManagement') 
@endsection



@section('header')
<script src="{{asset('js/orders.js')}}"></script>
<script src="{{asset('js/modalsCRUD.js')}}"></script>
<script src="{{asset('js/libraries/alertify.min.js')}}"></script>
<link rel="stylesheet" href="{{ asset('css/alertify.css')}}">t>
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="last-order" content="{{ $lastOrder }}">
@endsection



@section('content')
<div class="d-flex ButtonBar mb-4">
   <button name="Create" class="btn m-1">@lang('orders.createOrder')</button>
</div>
<div>
   <div class="table-responsive">
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
               <th scope="col">@lang('orders.dateCreated')</th>
               <th scope="col">@lang('orders.actions')</th>
            </tr>
         </thead>
         <tbody>
            @each('orders.layouts.tableRow', $orders, 'order')
         </tbody>
      </table>
   </div>


   </div>
</div>
@endsection