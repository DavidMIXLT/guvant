<tr class="DataRow invisible">
    <td>
        <div class="custom-control custom-checkbox">
            <input type="checkbox" name="checkBoxActionDelete" class="custom-control-input" id="customCheck{{$product->id}}" value="{{$product->id}}">
            <label class="custom-control-label" for="customCheck{{$product->id}}"></label>
        </div>
        
    </td>
    <td class="ProductID">{{$product->id}}</td>
    <td class="ProductName">{{$product->name}}</a>
    </td>
    <td class="ProductDescription">{{substr($product->description, 0, 60)}}</td>
    <td class="ProductStock">{{$product->stock}}</td>
    <td class="ProductDate">{{$product->created_at}}</td>

    <td>
        <div class="container">
            <button name="Delete" class="btn btn-danger btn-light-warning">@lang('products/index.delete')</button>
            <button name="Edit" class="btn btn-primary btn-light ">@lang('products/index.edit')</button>
        </div>
    </td>
</tr>