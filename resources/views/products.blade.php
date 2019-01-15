@extends('layouts.base') 
@section('title','Panel') 
@section('content')


<br/>
<a href="{{route('products.create')}}" class="btn btn-primary">Crear producto</a>
<br/>
<br/> @if (isset($alertaCreado)) @if ($alertaCreado)
<div class="alert alert-success" role="alert">
    @lang('messages.productCreated')
</div>
@else
<div class="alert alert-danger" role="alert">
    @lang('messages.productError')
</div>
@endif @endif @csrf @method('DELETE')
<table class="table">
    <thead class="thead-dark">
        <tr>
            <th scope="col"></th>
            <th onclick="test()" scope="col">ID</th>
            <th scope="col">Nombre</th>
            <th scope="col">Descripcion</th>
            <th scope="col">Stock</th>
            <th scope="col">Fecha creado</th>
            <th scope="col">Acciones</th>
        </tr>
    </thead>
    <tbody>


        @foreach ($products as $product)
        <tr>
            <td>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="checkBoxAction" value="{{$product->id}}">
                    <label class="form-check-label" for="checkBoxAction"></label>
                </div>
            </td>
            <td>{{$product->id}}</td>
            <td>{{$product->name}}</td>
            <td>{{$product->description}}</td>
            <td>{{$product->stock}}</td>
            <td>{{$product->created_at}}</td>

            <td>
                <form action="{{route('products.destroy',$product->id)}}" method="POST">
                    @csrf @method('DELETE')
                    <button name="submit" type="submit" class="btn btn-primary">Eliminar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<form id="massiveAction" action="{{route('products.destroy',-1)}}" method="POST">
    @csrf @method('DELETE')
    <input type="hidden" id="checkBoxList" name="productsToDelete" value="">
</form>
<div class="dropdown">
    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
        aria-expanded="false">
          Acciones massivas
        </button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <button type="button" class=" dropdown-item" id="deleteButton">Eliminacion de checkboxes</button>
        <button type="button" class=" dropdown-item" id="editButton">Editar</button>


    </div>
</div>
@endsection