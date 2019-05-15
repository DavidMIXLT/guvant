<div data-groupid="@isset($group) {{$group->id}}@endisset" id="accordion{{preg_replace('/\s+/', '', $title)}}" class="card m-1 accordion">
    <div class="card-header" id="headingTwo">
        <h5 class="mb-0">
            <div class="container edit d-none">
                <input class="form-control d-inline" placeholder="Introduce el titulo del grupo" type="text" value="{{preg_replace('/\s+/', '', $title)}}">
                <button name="send" type="button" class="btn btn-success btn-small mt-2 float-right">✓</button>
            </div>
            <div class="noEdit">

                <button class="btn btn-link collapsed collapseButton" data-toggle="collapse" data-target="#collapse{{preg_replace('/\s+/', '', $title)}}"
                    aria-expanded="false" aria-controls="collapseTwo">
                    {{$title}}
                </button>
                <button name="editGroup" type="button" class="btn btn-primary btn-small float-right">@lang('orders.edit')</button>
                <button name="deleteGroup" type="button" class=" btn btn-danger btn-small float-right mr-2">@lang('orders.delete')</button>
            </div>
        </h5>
    </div>
    <div id="collapse{{preg_replace('/\s+/', '', $title)}}" class="collapse" aria-labelledby="heading{{preg_replace('/\s+/', '', $title)}}"
        data-parent="#accordion">
        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">@lang('orders.id')</th>
                    <th scope="col">@lang('orders.name')</th>
                    <th scope="col"><button name="addItems" type="button" class="btn btn-success btn-sm">@lang('orders.add')</button></th>
                </tr>
            </thead>
            <tbody>
                @isset($group) @foreach ($group->plates as $plate)
                <tr data-type="plates" data-id="{{$plate->id}}">
                    <td>{{$plate->id}}</td>
                    <td>{{$plate->name}}</td>
                    <td><button name="DeleteGroupItem" class="btn btn-danger btn-light-warning">X</button></td>
                </tr>
                @endforeach @foreach ($group->products as $product)
                <tr data-type="products" data-id="{{$product->id}}">
                    <td>{{$product->id}}</td>
                    <td>{{$product->name}}</td>
                    <td><button name="DeleteGroupItem" class="btn btn-danger btn-light-warning">X</button></td>
                </tr>
                @endforeach @endisset
            </tbody>
        </table>

    </div>
</div>