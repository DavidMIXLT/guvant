<div class="form-group row">
    <label class="col-4 col-form-label" for="name">>@lang('orders.name')</label>
    <div class="col-8">
        <input id="name" name="name" type="text" class="form-control" required="required"
            value="Pedido #{{str_random(4)}}">
    </div>
</div>

<div class="form-group row">
        <label class="col-4 col-form-label" for="name">  <button name="AddMenu" class="btn btn-primary btn-light">@lang('orders.addMenu')</button></label>
  
    <div class="col-8">
        <select id="SelectedMenu" class="form-control  input-sm">
            @foreach ($menus as $menu)
            <option value="{{$menu->id}}">{{$menu->name}}</option>
            @endforeach
        </select>
    </div>
</div>




<button name="AddProduct" class="btn btn-primary btn-light  form-control">@lang('orders.addProduct')</button>
<button name="AddPlate" class="btn btn-primary btn-light  form-control">@lang('orders.addPlate')</button>