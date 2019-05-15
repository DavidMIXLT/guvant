
@extends('layouts.modal')

@section('title','Crear Menu')

@section('content')
    
        @include('menus.form.inputs')
    
@endsection


@section('footer')
    <button name="submitEdit" type="button" class="btn btn-primary">@lang('orders.save')</button>
    <button type="button" name="closeModal" class="btn btn-secondary" data-dismiss="modal">@lang('orders.close')</button>      
@endsection