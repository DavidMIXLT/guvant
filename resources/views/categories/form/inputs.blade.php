<div class="form-group row">
    <label for="name" class="col-4 col-form-label">@lang('categories.name')</label>
    <div class="col-8">
        <input value="@isset($category){{$category->name}} @endisset" id="name" name="name" placeholder="@lang('categories.name')" type="text" class="form-control" value="@isset($category){{$category->name}}@endisset">
    </div>
</div>
