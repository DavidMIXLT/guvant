<div class="form-group row">
  <label for="name" class="col-4 col-form-label">Nombre</label>
  <div class="col-8">
    <input id="name" name="name" type="text" class="form-control">
  </div>
</div>

<div id="accordion" class="mb-3">
  {{-----------------------------------------------------------------------------------------------------}}
  <div class="card m-1">
    <div class="card-header" id="headingOne">
 
      <h5 class="mb-0">
        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
            Entrantes
          </button>
      </h5>

    </div>

    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body">
        aaaa
      </div>
    </div>
  </div>
  {{-----------------------------------------------------------------------------------------------------}}
  <div class="card m-1">
    <div class="card-header" id="headingOne">
      <h5 class="mb-0">
        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseOne">
            Primer Plato
          </button>
      </h5>
    </div>

    <div id="collapseTwo" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body">
        aaaa
      </div>
    </div>
  </div>
  {{-----------------------------------------------------------------------------------------------------}}
  <div class="card">
    <div class="card-header m-1" id="headingOne">
      <h5 class="mb-0">
        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseOne">
            Segundo Plato
          </button>
      </h5>
    </div>

    <div id="collapseThree" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body">
        aaaa
      </div>
    </div>
  </div>
  {{-----------------------------------------------------------------------------------------------------}}
  <div class="card">
    <div class="card-header m-1" id="headingOne">
      <h5 class="mb-0">
        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseOne">
           Postre
          </button>
      </h5>
    </div>

    <div id="collapseFour" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body">
        aaaa
      </div>
    </div>
  </div>
  {{-----------------------------------------------------------------------------------------------------}}
  <div class="card">
    <div class="card-header m-1" id="headingOne">
      <h5 class="mb-0">
        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseFive" aria-expanded="true" aria-controls="collapseOne">
           Bebidas
          </button>
      </h5>
    </div>

    <div id="collapseFive" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body">
        aaaa
      </div>
    </div>
  </div>
  {{-----------------------------------------------------------------------------------------------------}}
</div>


<div class="form-group row">
  <label for="price" class="col-4 col-form-label">Precio</label>
  <div class="col-8">
    <input id="price" name="price" type="text" class="form-control">
  </div>
</div>