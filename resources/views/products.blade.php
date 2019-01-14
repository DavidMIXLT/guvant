@extends('layouts.base')

@section('title','Panel')

@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <br/>
    <a href="products/create" class="btn btn-primary">Crear producto</a>
    <br/>
    <br/>
    @if (isset($alertaCreado))
        @if ($alertaCreado)
            <div class="alert alert-success" role="alert">
                 Producto creado correctamente
            </div>
        @else
            <div class="alert alert-danger" role="alert">
                Producto no se ha podido crear
           </div>
        @endif
    @endif
    <table class="table">
            <thead class="thead-dark">
              <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre</th>
                <th scope="col">Descripcion</th>
                <th scope="col">Stock</th>
                <th scope="col">Fecha creado</th>
              </tr>
            </thead>
            <tbody>
         
               
                @foreach ($products as $product)
                <tr>
                <td>{{$product->id}}</td>
                <td>{{$product->name}}</td>
                <td>{{$product->description}}</td>
                <td>{{$product->stock}}</td>
                <td>{{$product->created_at}}</td>
                </tr>
                @endforeach
            </tbody>
          </table>

@endsection