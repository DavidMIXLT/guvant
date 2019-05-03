
<tr class="DataRow invisible">
        <td>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" name="checkBoxActionDelete" value="{{$user->id}}">
                <label class="form-check-label" for="checkBoxAction"></label>
            </div>
        </td>
        <td class="ID">{{$user->id}}</td>
        <td class="Name">{{$user->name}}</td>
        <td class="Actions">
            <button value="{{$user->id}}" name="Delete" class="btn btn-danger ">@lang('products/index.delete')</button>
            <button value="{{$user->id}}" name="Edit" class="btn btn-primary ">@lang('products/index.edit')</button>
        </td>
    </tr>