<tr class="DataRow invisible">
    <td>
        <div class="form-check ">
            <input type="checkbox" class="form-check-input" name="checkBoxActionDelete" value="{{$menu->id}}">
            <label class="form-check-label" for="checkBoxAction"></label>
        </div>
    </td>
    <td class="Id">{{$menu->id}}</td>
    <td class="Name">{{$menu->name}}
    </td>
    <td class="Price">{{$menu->price}}
    </td>
    <td>
        <div class="container">
            <button name="Delete" class="btn btn-danger ">@lang('products/index.delete')</button>
            <button name="Edit" class="btn btn-primary ">@lang('products/index.edit')</button>
        </div>
    </td>
</tr>