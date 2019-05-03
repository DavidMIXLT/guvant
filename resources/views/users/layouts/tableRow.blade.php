<tr class="DataRow invisible">
        <td>
            <div class="custom-control custom-checkbox">
                <input type="checkbox" name="checkBoxActionDelete" class="custom-control-input" id="customCheck{{$order->id}}" value="{{$product->id}}">
                <label class="custom-control-label" for="customCheck{{$order->id}}"></label>
            </div>
            
        </td>
        <td class="ProductID">{{$order->id}}</td>
        <td class="ProductName">{{$order->name}}</a>
        </td>
        <td>
            <div class="container">
                <button name="Delete" class="btn btn-danger btn-light-warning">Borrar</button>
                <button name="Edit" class="btn btn-primary btn-light ">Editar</button>
            </div>
        </td>
    </tr>