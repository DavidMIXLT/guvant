<tr class="DataRow invisible">
    <td>
        <div class="form-check ">
            <input type="checkbox" class="form-check-input" name="checkBoxActionDelete" value="{{$product->id}}">
            <label class="form-check-label" for="checkBoxAction"></label>
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
            <button name="Delete" class="btn btn-danger ">@lang('products/index.delete')</button>
            <button name="Edit" class="btn btn-primary ">@lang('products/index.edit')</button>
        </div>
    </td>
</tr>