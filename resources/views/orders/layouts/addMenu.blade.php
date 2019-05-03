<!--     -->

<div class="card">
    <div class="card-header" id="heading{{$id}}"  data-toggle="collapse" data-target="#collapse{{$id}}" aria-expanded="false" aria-controls="collapse{{$id}}">
        <h5 class="mb-0">
            <button name="menuBtn" class="btn btn-link collapsed" data-id="{{$menu->id}}">
                {{$id}} : {{$menu->name}}
              </button>
            <button name="deleteGroup" type="button" class=" btn btn-danger btn-small float-right mr-2">Eliminar</button>
        </h5>
</div>

<div id="collapse{{$id}}" class="collapse" aria-labelledby="heading{{$id}}" data-parent="#accordion">
        <div class="card-body">
            <ul class="itemsList">
                @foreach ($menu->groups as $group)
                <li class="groupID" data-id="{{$group->id}}">{{$group->name}}</li>
                <ul>
                    @foreach ($group->products as $product)
                    <li data-id="{{$product->id}}" data-type="product" class="itemMenu">{{$product->name}}</li>
                    @endforeach @foreach ($group->plates as $plate)
                    <li data-id="{{$plate->id}}" data-type="plate" class="itemMenu"> {{$plate->name}}</li>
                    @endforeach
                </ul>
                @endforeach
            </ul>
        </div>
    </div>
</div>