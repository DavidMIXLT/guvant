<div class="form-group row">
    <label for="name" class="col-4 col-form-label">Nombre</label>
    <div class="col-8">
        <input id="name" name="name" placeholder="Nombre" type="text" class="form-control" value="@isset($category){{$category->name}}@endisset">
    </div>
</div>
