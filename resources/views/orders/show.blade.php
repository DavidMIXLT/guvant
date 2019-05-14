@extends('layouts.modal')




@section('title', $order->name)




@section('content')


<div class="table-responsive">
        <table class="table" id="orderItemsTable">
                <thead>
                        <tr>
                                <th scope="col" id="Name">@lang('orders.name')</th>
                                <th scope="col" id="Name">@lang('orders.quantity')</th>
                                <th scope="col" id="Name">@lang('orders.actions')</th>
                        </tr>
                </thead>
                <tbody>
                        @foreach ($order->products as $product)
                        <tr>
                                <td>{{$product->name}}</td>
                                <td>{{$product->pivot->quantity}}</td>
                                <td></td>
                        </tr>
                        @endforeach
                        @foreach ($order->plates as $plate)
                                <td>{{$plate->name}}</td>
                                <td>{{$plate->pivot->quantity}}</td>
                                <td></td>
                        </tr>
                        @endforeach
                </tbody>
        </table>
</div>
@endsection










@section('footer')
<button type="button" name="closeModal" class="btn btn-secondary" data-dismiss="modal">@lang('plates.close')</button>
@endsection