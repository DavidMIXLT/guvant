@extends('layouts.modal')


@section('title','Editar Usuario')


@section('content')
<form id="modalForm">
    @include('users.forms.inputs')
</form>
@endsection



@section('footer')
<button name="submitEdit" type="button" class="btn btn-primary">@lang('Users.save')</button>
<button type="button" name="closeModal" class="btn btn-secondary" data-dismiss="modal">@lang('Users.close')</button>
@endsection