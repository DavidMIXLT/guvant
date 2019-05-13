
<tr class="DataRow invisible status{{$order->status}}">
<td></td>
    <td class="ID">{{$order->id}}</td>
    <td class="Name">{{$order->name}}</td>
<td class="Date">{{$order->created_at}}</td>
    <td class="Actions">
        @if($order->status != 2)
        <button data-id="{{$order->id}}" name="Delete" class="btn btn-danger btn-light-warning">Cancelar</button>
        @endif
        <button data-id="{{$order->id}} " name="ViewOrder" type="button" class="btn btn-info">Mostrar</button>
        @if ($order->status == 0)
        <button data-id="{{$order->id}}" name="Accept" class="btn btn-warning">Aceptar</button>         
        @endif
        @if ($order->status == 1)
        <button data-id="{{$order->id}}" name="Complete" class="btn btn-success">✓</button>         
        @endif
       
    </td>
</tr>