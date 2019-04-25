<tr class="DataRow invisible">
    <td>
        <div class="form-check">
            <input type="checkbox" class="form-check-input" name="checkBoxActionDelete" value="{{$plate->id}}">
            <label class="form-check-label" for="checkBoxAction"></label>
        </div>
    </td>
    <td class="ID">{{$plate->id}}</td>
    <td class="Name">{{$plate->name}}</td>
    <td class="Description">{{$plate->description}}</td>
    <td class="Products">
        <button name="Show" value="{{$plate->id}}" type="button" class="btn btn-info">@lang('plates.show')</button>
    </td>
    <td class="Actions">
        <button value="{{$plate->id}}" name="Delete" class="btn btn-danger ">@lang('products/index.delete')</button>
        <button value="{{$plate->id}}" name="Edit" class="btn btn-primary ">@lang('products/index.edit')</button>
    </td>
</tr>