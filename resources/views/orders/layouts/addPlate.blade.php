@extends('layouts.modal') 
@section('title','Crear Menu') 
@section('content')

<div class="d-flex flex-row h-75">

    <div class="flex-even">
        <div class="card">
            <div class="card-header">
                @lang('orders.dishesAvailable') 
            </div>
            <ul id="AvaibleList" class="list-group list-group-flush">
      
            
        
                <li id="pagination" class="list-group-item">
                
                </li>
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
<button name="submitEdit" type="button" class="btn btn-primary">@lang('orders.save')</button>
<button type="button" name="closeModal" class="btn btn-secondary" data-dismiss="modal">@lang('orders.close')</button>
@endsection