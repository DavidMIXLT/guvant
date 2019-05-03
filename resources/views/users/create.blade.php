
@extends('layouts.modal')

@section('title','Crear Usuario')

@section('content')
    <form id="modalForm">
        @include('user.form.inputs')
    </form>
@endsection


@section('footer')
    <button name="submitEdit" type="button" class="btn btn-primary">Guardar</button>
    <button type="button" name="closeModal" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>      
@endsection