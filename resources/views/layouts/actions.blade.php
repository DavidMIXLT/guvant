<div class="container pb-5 float-left">
    <div class="dropdown m-2 d-inline">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">
                    @lang('general.Massiveactions')
                    </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <button type="button" class=" dropdown-item" id="SelectAll">Seleccionar Todo</button>
            <button type="button" class=" dropdown-item" id="MassiveDeleteButton">@lang('products/index.deleteSelectedItems')</button>
        </div>
    </div>
    <select id="NumberOfElements" class=" form-control float-right w-25 input-sm">
        <option>1</option>
        <option>5</option>
        <option>10</option>
        <option>15</option>
        <option>20</option>
        <option>25</option>
    </select>
</div>