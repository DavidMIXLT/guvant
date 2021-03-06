<div class="form-group row">
    <label for="Nombre" class="col-4 col-form-label">@lang('products.name') (*)</label>
    <div class="col-8">
        <input value="{{$product->name}}" id="Name" name="name" type="text" class="form-control here" required>
        <small id="nameHelp" class="invisible text-danger text-center">
            @lang('products.nameRequired')
            </small>
    </div>
</div>

<div class="form-group row">
    <label for="Descripcion" class="col-4 col-form-label">Descripcion (*)</label>
    <div class="col-8">
        <textarea maxlength="255" {{$product->description}} id="description" name="description" cols="40" rows="5" class="form-control">{{$product->description}}</textarea>
        <small id="descriptionHelp" class="invisible  text-danger text-center">
            @lang('products.descriptionRequired') 
            </small>

    </div>
</div>
<div class="form-group row">
    <label for="text" class="col-4 col-form-label">Stock (*)</label>
    <div class="col-8">
        <input type="number" min="0" max="9223372036854775808" id="stock" value="{{$product->stock}}" name="stock" type="text" class="form-control here"
            required>
        <small id="stockHelp" class="invisible  text-danger text-center">
            @lang('products.stockRequired')   
            </small>
    </div>

</div>

<div class="d-flex flex-row h-75">
    <div class="flex-even">
        <div class="card">
            <div class="card-header">
                @lang('products.availableCategories') 
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
                @lang('products.selectedCategories') 
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