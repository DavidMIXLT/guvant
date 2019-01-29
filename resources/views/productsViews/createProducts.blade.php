<div class="modal" id="productModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">@lang('products/productsCreate.createNewProduct')</h5>
        <button name="closeModal" type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="productForm">
  @include('productsViews.form.basicInputs')
          <div class="modal-footer">
            <button name="submitEdit" type="submit" class="btn btn-primary">Enviar</button>
            <button type="button" class="btn btn-secondary" name="closeModal">Cerrar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>