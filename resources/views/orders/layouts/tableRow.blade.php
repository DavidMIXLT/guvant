
<tr class="DataRow invisible">
    <td>
        <div class="form-check">
            <input type="checkbox" class="form-check-input" name="checkBoxActionDelete" value="{{$order->id}}">
            <label class="form-check-label" for="checkBoxAction"></label>
        </div>
    </td>
    <td class="ID">{{$order->id}}</td>
    <td class="Name">{{$order->name}}</td>
    <td class="Date">{{$order->created_at}}</td>
    <td class="Actions">
        <button data-id="{{$order->id}} " name="ViewOrder" type="button" class="btn btn-info">Mostrar</button>
        <button data-id="{{$order->id}}" name="Delete" class="btn btn-danger btn-light-warning">Borrar</button>
    </td>
</tr>