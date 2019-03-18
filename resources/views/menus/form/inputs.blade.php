<div class="form-group row">
  <label for="name" class="col-4 col-form-label">Nombre</label>
  <div class="col-8">
    <input id="name" name="name" type="text" class="form-control" value="@isset($menu){{$menu->name}}@endisset">
  </div>
</div>
<button name="CreateGroup" type="button" class="btn btn-success m-3">Crear grupo</button>

<div id="accordion" class="mb-3">
  @if (isset($menu))
    @foreach ($menu->groups as $group)
      @include('menus.layouts.groups',["title" => $group->name,"group" => $group])
    @endforeach
  @else
    @include('menus.layouts.groups',["title" => "Entrantes"])
  @endif


</div>


<div class="form-group row">
  <label for="price" class="col-4 col-form-label">Precio</label>
  <div class="col-8">
    <input id="price" name="price" type="text" class="form-control" value="@isset($menu){{$menu->price}}@endisset">
  </div>
</div>