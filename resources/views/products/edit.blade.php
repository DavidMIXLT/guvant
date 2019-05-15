
@extends('layouts.modal')

@section('title',__("products/index.edit"))

@section('content')
    <form id="modalForm">
        @include('products.form.inputs')
    </form>
@endsection

@section('footer')
    <button name="submitEdit" type="button" class="btn btn-primary">@lang('products.save')</button>
    <button type="button" name="closeModal" class="btn btn-secondary" data-dismiss="modal">@lang('products.close')</button>      
@endsection