<!--     -->

    <div class="card">
        <div class="card-header" id="heading{{$id}}">
            <h5 class="mb-0">
                <button class="btn btn-link" data-toggle="collapse" data-target="#collapse{{$id}}" aria-expanded="true" aria-controls="collapse{{$id}}">
               Menu {{$id}} : {{$menu->name}}
              </button>
              <button name="deleteGroup" type="button" class=" btn btn-danger btn-small float-right mr-2">Eliminar</button>
            </h5>
        </div>

        <div id="collapse{{$id}}" class="collapse show" aria-labelledby="heading{{$id}}" data-parent="#accordion">
            <div class="card-body">
                <ul>
                    @foreach ($menu->groups as $group)
                    <li>{{$menu->name}}</li>
                    <ul>
                        @foreach ($group->products as $product)
                        <li> {{$product->name}}</li>
                        @endforeach @foreach ($group->plates as $plate)
                        <li> {{$plate->name}}</li>
                        @endforeach
                    </ul>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>


