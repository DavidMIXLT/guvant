<div class="form-group row">
    <label for="name" class="col-4 col-form-label">Nombre</label>
    <div class="col-8">
        <input id="name" name="name" placeholder="Nombre" type="text" class="form-control" value="@isset($SelectedProducts){{$SelectedProducts->name}}@endisset">
    </div>
</div>
<div class="form-group row">
    <label for="description" class="col-4 col-form-label">Descripcion</label>
    <div class="col-8">
        <input id="description" name="description" placeholder="Descripcion" type="text" class="form-control" value="@isset($SelectedProducts){{$SelectedProducts->description}}@endisset">
    </div>
</div>

<div class="d-flex flex-row h-75">

    <div class="flex-even">
        <div class="card">
            <div class="card-header">
                Lista productos
            </div>
            <ul id="ProductList" class="list-group list-group-flush">

                @foreach ($products as $product)
                <li value="{{$product->id}}" class="list-group-item productItem">
                    {{$product->name}}
                </li>
                @endforeach

            </ul>
        </div>
    </div>
    <div class="flex-even">
        <div class="card">
            <div class="card-header">
                Productos seleccionados
            </div>
            <ul id="SelectedProducts" class="list-group list-group-flush">
                @isset($SelectedProducts) @foreach ($SelectedProducts->products as $product)
                <li value="{{$product->id}}" class="list-group-item productItem">
                    {{$product->name}}
                </li>
                @endforeach @endisset


            </ul>
        </div>
    </div>

</div>