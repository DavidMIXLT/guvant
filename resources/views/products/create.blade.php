
@extends('layouts.modal')

@section('title','Crear Producto')

@section('content')
    <form id="modalForm">
        @include('products.form.inputs')
    </form>
@endsection


@section('footer')
    <button name="submitEdit" type="button" class="btn btn-primary">@lang('products.save')</button>
    <button type="button" name="closeModal" class="btn btn-secondary" data-dismiss="modal">@lang('products.close')</button>      
@endsection