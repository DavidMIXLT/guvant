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

<div class="d-flex flex-row h-75">

        <div class="flex-even">
            <div class="card">
                <div class="card-header">
                    Categorias Disponibles
                </div>
                <ul id="AvaibleList" class="list-group list-group-flush">
                    @foreach ($categories as $category)
                    <li value="{{$category->id}}" class="list-group-item Item">
                        {{$category->name}}
                    </li>
                    @endforeach
    
                </ul>
            </div>
        </div>
        <div class="flex-even">
            <div class="card">
                <div class="card-header">
                    Categorias seleccionados
                </div>
                <ul id="SelectedList" class="list-group list-group-flush">
                    @isset($SelectedCategories) @foreach ($SelectedCategories as $category)
                    <li value="{{$category->id}}" class="list-group-item Item">
                        {{$category->name}}
                    </li>
                    @endforeach @endisset
    
    
                </ul>
            </div>
        </div>
    
    </div>