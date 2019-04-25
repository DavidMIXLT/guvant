@extends('layouts.modal')

@section('title','Crear Plato')

@section('content')
    <form id="modalForm">
        @include('plates.form.inputs')
    </form>
@endsection

@section('footer')
    <button name="submitEdit" type="button" class="btn btn-primary">@lang('plates.save')</button>
    <button type="button" name="closeModal" class="btn btn-secondary" data-dismiss="modal">@lang('plates.close')</button>      
@endsection
