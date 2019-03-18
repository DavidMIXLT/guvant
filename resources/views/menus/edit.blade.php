@extends('layouts.modal') 
@section('title','Editar Menu') 
@section('content')
@include('menus.form.inputs')
@endsection
 
@section('footer')
<button name="submitEdit" type="button" class="btn btn-primary">Guardar</button>
<button type="button" name="closeModal" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
@endsection