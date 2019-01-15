@extends('layouts.base') 
@section('title','Panel') 
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
    <label for="Nombre" class="col-4 col-form-label">Nombre</label>
    <div class="col-8">
      <input id="Name" name="Name" type="text" class="form-control here" required="required">
    </div>
  </div>
  <div class="form-group row">
    <label for="Descripcion" class="col-4 col-form-label">Descripcion</label>
    <div class="col-8">
      <textarea id="Description" name="Description" cols="40" rows="5" class="form-control"></textarea>
    </div>
  </div>
  <div class="form-group row">
    <label for="text" class="col-4 col-form-label">Stock</label>
    <div class="col-8">
      <input id="Stock" name="Stock" type="text" class="form-control here">
    </div>
  </div>
  <div class="form-group row">
    <div class="offset-4 col-8">
      <button name="submit" type="submit" class="btn btn-primary">Crear producto</button>
    </div>
  </div>
</form>
@endsection