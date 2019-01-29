<div class="form-group row">
    <label for="Nombre" class="col-4 col-form-label">Nombre</label>
    <div class="col-8">
        <input value="{{$product->name}}" id="Name" name="Name" type="text" class="form-control here" required>
    </div>
</div>
<div class="form-group row">
    <label for="Descripcion" class="col-4 col-form-label">Descripcion</label>
    <div class="col-8">
        <textarea maxlength="255" {{$product->description}} id="Description" name="Description" cols="40" rows="5" class="form-control">{{$product->description}}</textarea>
    </div>
</div>
<div class="form-group row">
    <label for="text" class="col-4 col-form-label">Stock</label>
    <div class="col-8">
        <input type="number" min="0" max="9223372036854775808" id="Stock" value="{{$product->stock}}" name="Stock" type="text" class="form-control here"
            required>
    </div>
</div>
</div>