<div id="accordion{{$title}}" class="card m-1 accordion">
    <div class="card-header" id="headingTwo">
        <h5 class="mb-0">
            <div class="container edit d-none">
                <input class="form-control d-inline" placeholder="Introduce el titulo del grupo" type="text" value="{{$title}}">
                <button name="send" type="button" class="btn btn-success btn-small mt-2 float-right">✓</button>
            </div>
            <div class="noEdit">

                <button class="btn btn-link collapsed collapseButton" data-toggle="collapse" data-target="#collapse{{$title}}" aria-expanded="false"
                    aria-controls="collapseTwo">
                    {{$title}}
                </button>
                <button name="editGroup" type="button" class="btn btn-primary btn-small float-right">Editar</button>
                <button name="deleteGroup" type="button" class=" btn btn-danger btn-small float-right mr-2">Eliminar</button>
            </div>
        </h5>
    </div>
    <div id="collapse{{$title}}" class="collapse" aria-labelledby="heading{{$title}}" data-parent="#accordion">
        <table class="table table-striped">
            <thead class="thead">
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Nombre</th>
                    <th scope="col"><button name="addItems" type="button" class="btn btn-success btn-sm">Añadir</button></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td></td>
                </tr>
            </tbody>
        </table>

    </div>
</div>