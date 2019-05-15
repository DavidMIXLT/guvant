
@extends('layouts.modal')

@section('title',__('menus.createMenu'))

@section('content')
    
        @include('menus.form.inputs')
    
@endsection


@section('footer')
    <button name="submitEdit" type="button" class="btn btn-primary">@lang('menus.save')</button>
    <button type="button" name="closeModal" class="btn btn-secondary" data-dismiss="modal">@lang('menus.close')</button>      
@endsection