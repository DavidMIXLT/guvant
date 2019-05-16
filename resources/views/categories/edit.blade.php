@extends('layouts.modal')

@section('title',__('categories.edit'))

@section('content')
    <form id="modalForm">
        @include('categories.form.inputs')
    </form>
@endsection

@section('footer')
    <button name="submitEdit" type="button" class="btn btn-primary">@lang('categories.save')</button>
    <button type="button" name="closeModal" class="btn btn-secondary" data-dismiss="modal">@lang('categories.close')</button>      
@endsection
