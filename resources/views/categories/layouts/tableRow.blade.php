
<tr class="DataRow invisible">
    <td>
        <div class="form-check">
            <input type="checkbox" class="form-check-input" name="checkBoxActionDelete" value="{{$category->id}}">
            <label class="form-check-label" for="checkBoxAction"></label>
        </div>
    </td>
    <td class="ID">{{$category->id}}</td>
    <td class="Name">{{$category->name}}</td>
    <td class="Actions">
        <button value="{{$category->id}}" name="Delete" class="btn btn-danger ">@lang('products/index.delete')</button>
        <button value="{{$category->id}}" name="Edit" class="btn btn-primary ">@lang('products/index.edit')</button>
    </td>
</tr>