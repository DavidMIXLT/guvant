
<tr class="DataRow invisible status{{$order->status}}">
<td></td>
    <td class="ID">{{$order->id}}</td>
    <td class="Name">{{$order->name}}</td>
<td class="Date">{{$order->created_at}}</td>
    <td class="Actions">
        @if($order->status != 2)
        <button data-id="{{$order->id}}" name="Delete" class="btn btn-danger btn-light-warning">@lang('orders.cancel')</button>
        @endif
        <button data-id="{{$order->id}} " name="ViewOrder" type="button" class="btn btn-info">@lang('orders.toShow')</button>
        @if ($order->status == 0)
        <button data-id="{{$order->id}}" name="Accept" class="btn btn-warning">@lang('orders.toAccept')</button>         
        @endif
        @if ($order->status == 1)
        <button data-id="{{$order->id}}" name="Complete" class="btn btn-success">✓</button>         
        @endif
       
    </td>
</tr>