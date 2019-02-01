@extends('layouts.modal')

@section('title','Crear Plato')

@section('content')
    <form id="modalForm">
        @include('platesViews.form.inputs')
    </form>
@endsection