@extends('layouts.modal') 
@section('title','Crear Menu') 
@section('content')

<div class="d-flex flex-row h-75">

    <div class="flex-even">
        <div class="card">
            <div class="card-header">
                @lang('orders.available') 
            </div>
            <ul id="AvaibleList" class="list-group list-group-flush">
                <div class="container" id="menu">
                    <li id="Products" class="list-group-item ">
                        @lang('orders.products')
                    </li>
                    <li id="Plates" class="list-group-item ">
                        @lang('orders.plates') 
                    </li>
                </div>
                <li id="pagination" class="list-group-item"> </li>
                <li class="list-group-item"> <button name="back" class="btn btn-primary">@lang('orders.goBack') </button> </li>
            </ul>
        </div>
    </div>
    <div class="flex-even">
        <div class="card">
            <div class="card-header">
                @lang('orders.select') 
            </div>
            <ul id="SelectedList" class="list-group list-group-flush">



            </ul>
        </div>
    </div>

</div>
@endsection
 
@section('footer')
<button name="submitEdit" type="button" class="btn btn-primary"> @lang('orders.save') </button>
<button type="button" name="closeModal" class="btn btn-secondary" data-dismiss="modal"> @lang('orders.close') </button>
@endsection