
@extends('layouts.modal')

@section('title','Editar Producto')

@section('content')
    <form id="modalForm">
        @include('products.form.inputs')
    </form>
@endsection