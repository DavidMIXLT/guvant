@extends('layouts.base') 
@section('title','Editar Producto') 
@section('subtitle')
Editando producto - {{$product->name}}
@endsection
@section('content') @if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<br/>

<form method="POST" action="{{ route('products.index') }}">
    @CSRF
    <div class="form-group row">
        <label for="Nombre" class="col-4 col-form-label">ID</label>
        <div class="col-8">
        <input class="form-control here" type="text" value="{{$product->id}}" name="Id" readonly>
        </div>
    </div>
    <div class="form-group row">

        <label for="Nombre" class="col-4 col-form-label">Nombre</label>
        <div class="col-8">

            <input value="{{$product->name}}" id="Name" name="Name" type="text" class="form-control here" required="required">
        </div>
    </div>
    <div class="form-group row">
        <label for="Descripcion" class="col-4 col-form-label">Descripcion</label>
        <div class="col-8">
            <textarea {{$product->description}} id="Description" name="Description" cols="40" rows="5" class="form-control">{{$product->description}}</textarea>
        </div>
    </div>
    <div class="form-group row">
        <label for="text" class="col-4 col-form-label">Stock</label>
        <div class="col-8">
            <input id="Stock" value="{{$product->stock}}" name="Stock" type="text" class="form-control here">
        </div>
    </div>
    <div class="form-group row">
        <div class="offset-4 col-8">
            <button name="submit" type="submit" class="btn btn-primary">Actualizar producto</button>
        </div>
    </div>
</form>
@endsection