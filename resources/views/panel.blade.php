@extends('layouts.base')



@section('title','Panel')



@section('header')
<script src="{{asset('js/libraries/feather.min.js')}}"></script>
<script src="{{asset('js/libraries/chart.min.js')}}"></script>
<script src="{{asset('js/panel.js')}}"></script>
<script src="{{asset('js/modalsCRUD.js')}}"></script>
<script src="{{asset('js/libraries/alertify.min.js')}}"></script>
<link rel="stylesheet" href="{{ asset('css/alertify.css')}}">t>
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection




@section('content')
<div class="container">
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2 ml-2"> @lang('Users.mainPanel')</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group mr-2">
            <button type="button" class="btn btn-sm btn-outline-secondary">@lang('Users.share')</button>
            <button type="button" class="btn btn-sm btn-outline-secondary">@lang('Users.toExport')</button>
        </div>
        <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
            <span data-feather="calendar"></span>
            @lang('Users.thisWeek')
        </button>
    </div>
</div>

<canvas class="my-4 w-100" id="myChart" width="900" height="250"></canvas>

<h2>@lang('Users.recentOrders')</h2>
<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">
                    <div class="spinner-border invisible" role="status">
                        <span class="sr-only">@lang('Users.loading')</span>
                    </div>
                </th>
                <th scope="col">@lang('Users.id')</th>
                <th scope="col">@lang('Users.name')</th>
                <th scope="col">@lang('Users.dateCreate')</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)

            <tr class="DataRow invisible">
                <td></td>
                <td class="ID">{{$order->id}}</td>
                <td class="Name">{{$order->name}}</td>
                <td class="Date">{{$order->created_at}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</div>
</div>
@endsection