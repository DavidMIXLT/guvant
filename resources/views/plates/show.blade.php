@extends('layouts.modal') 
@section('title',"Mostrar - " . $plate->name) 
@section('content') 
        <ul>
        @foreach ($plate->products as $product)
        <li>{{$product->name}}</li>
        @endforeach
        </ul>
@endsection


@section('footer')
<button type="button" name="closeModal" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>   
@endsection