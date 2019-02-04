
@extends('layouts.modal')

@section('title','Crear Producto')

@section('content')
    <form id="modalForm">
        @include('products.form.inputs')
    </form>
@endsection