<div class="modal" id="editModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Actualizar producto - {{$product->name}}</h5>
                <button name="closeModal" type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
            </div>
            <div class="modal-body">
                <form id="editProduct">
                    <div class="form-group row">
                        <label for="Nombre" class="col-4 col-form-label">ID</label>
                        <div class="col-8">
                            <input class="form-control here" type="text" value="{{$product->id}}" name="Id" readonly>
                        </div>
                    </div>
                    <div class="form-group row">

                        <label for="Nombre" class="col-4 col-form-label">Nombre</label>
                        <div class="col-8">

                            <input value="{{$product->name}}" id="Name" name="Name" type="text" class="form-control here" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Descripcion" class="col-4 col-form-label">Descripcion</label>
                        <div class="col-8">
                            <textarea {{$product->description}} id="Description" name="Description" cols="40" rows="5" class="form-control">{{$product->description}}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="text" class="col-4 col-form-label">Stock</label>
                        <div class="col-8">
                            <input id="Stock" value="{{$product->stock}}" name="Stock" type="text" class="form-control here" required>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button name="submitEdit" type="submit" class="btn btn-primary">Actualizar producto</button>
                </form>
                <button type="button" class="btn btn-secondary" name="closeModal">Cerrar</button>
            </div>
        </div>
    </div>
</div>