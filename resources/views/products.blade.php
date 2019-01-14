@extends('layouts.base')

@section('title','Panel')

@section('content')


    <br/>
    <a href="products/create" class="btn btn-primary">Crear producto</a>
    <br/>
    <br/>

    @if (isset($alertaCreado))
        @if ($alertaCreado)
            <div class="alert alert-success" role="alert">
            @lang('messages.productCreated')
            </div>
        @else
            <div class="alert alert-danger" role="alert">
            @lang('messages.productError')
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
                <th scope="col">Acciones</th>
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
                <td>
                <form action="{{route('products.destroy',$product->id)}}" method="POST">    
                    @csrf  
                        @method('DELETE')                       
                        <button name="submit" type="submit" class="btn btn-primary">Eliminar</button>                          
                    </form>
                </td>
                </tr>
                @endforeach
            </tbody>
          </table>

@endsection