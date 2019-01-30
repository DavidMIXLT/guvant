/**
  * Variable usada para guardar la ultima columna que el usuario a hecho click
  */
var RowClicked;

/**
 * Ejecutado cuando la pagina acaba de cargar
 */
$(document).ready(function () {
  alertify.set('notifier', 'position', 'top-right');
  $("#MassiveDeleteButton").click(function () {
    massiveElimination();
  });

  $("#SelectAll").click(function () {
    selectAll();
  });

  $("button[name=Create]").click(function () {
    createModal("create", $(this).parent().parent().parent().find(".ProductID").text());
  });
  loadTableSortEvents();
  loadButtonTableEvents();
  console.log("----- Products.js Loaded -----");
});


/**
 * Carga los eventos de los Botones de editar y eliminar de la tabla
 */
function loadButtonTableEvents() {
  $("button[name=Delete]").on('click', function () {
    delete_product($(this).parent().parent().parent().find(".ProductID").text());
    RowClicked = $(this).parent().parent().parent();
  });
  $("button[name=Edit]").on('click', function () {

    createModal("edit", $(this).parent().parent().parent().find(".ProductID").text());
    RowClicked = $(this).parent().parent().parent();
  });

}

/**
 * Selecciona todas las checkbox
 */
function selectAll() {
  $("input[type=checkbox]").each(function () {
    $(this).prop('checked', true);
  });
}

/**
  * Carga los eventos para ordenar la tabla al pulsar en las cabecera
  */
function loadTableSortEvents() {
  document.getElementById('idRow').addEventListener('click', function (event) {
    sortTableInt(1);
  });
  document.getElementById('nameRow').addEventListener('click', function (event) {
    sortTableString(2);
  });
  document.getElementById('descriptionRow').addEventListener('click', function (event) {
    sortTableString(3);
  });
  document.getElementById('stockRow').addEventListener('click', function (event) {
    sortTableInt(4);
  });
  document.getElementById('dateRow').addEventListener('click', function (event) {
    sortTableDate(5);
  });

}

/**
  * Elimina las columnas que se le pasan de una tabla
  * 
  * @param  array of <TR>
  */

function ren_RemoveRow(ren_rows) {
  $(ren_rows).each(function () {
    $(this).remove();
  });
}

/**
  * Obtiene todos los IDS de los checkbox selecionados en productos.index
  *
  * @return Response AJAX
  */

function massiveElimination() {

  var ListOfID = new Array();
  var rows = $("input[type=checkbox][name=checkBoxActionDelete]:checked").parents("tr");

  $("input[type=checkbox][name=checkBoxActionDelete]:checked").each(function () {
    ListOfID.push($(this).val())
  });

  ren_spinner(true);

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $.ajax(
    {
      url: "products/-1",
      type: 'delete', // replaced from put
      dataType: "JSON",
      data: {
        "ListOfID": ListOfID // method and token not needed in data
      },
      success: function (response) {
        console.log(response); // see the reponse sent
        $(rows).fadeOut("fast", function () {
          ren_RemoveRow(rows);
        });

        ren_spinner(false);
      },
      error: function (xhr) {
        console.log(xhr.responseText); // this line will save you tons of hours while debugging
        // do something here because of error

        ren_spinner(false);
      }
    });
}

/**
  * Renderiza el spinner de loading en la tabla de productos
  * 
  * @param Boolean $ren 
  * 
  */
function ren_spinner($ren) {
  if ($ren) {
    $(".spinner-border").removeClass("invisible");
  } else {
    $(".spinner-border").addClass("invisible");
  }
}

/**
  * Elimina el producto cuando el usuario pulsa el boton de Eliminar
  *  @param int ProductID
  */
function delete_product(id) {
  ajaxRequest("products/" + id, 'DELETE', null, function (response) {
    console.log(response);
    ren_RemoveRow(RowClicked);
    ren_spinner(false);
  });
}

/**
  * Actualiza las columnas con los nuevos datos
  *  @param Row columna
  */
function updateRow(row, date = "-1", id = "-1") {

  row.find(".ProductName").text($('input[name="Name"]').val());
  row.find(".ProductStock").text($('input[name="Stock"]').val());
  row.find(".ProductDescription").text($('textarea[name="Description"]').val());
  if (date != "-1") {
    row.find(".ProductDate").text(date);
  }
  if (id != "-1") {
    row.find(".ProductID").text(id);
  }

}
/**
  * Cierra la ventana Model y la elimina
  *  @param Modal modal
  */
function closeModal(Modal) {
  Modal.modal('hide');
  Modal.remove();
}

function createModal(Modal, id = -1) {
  switch (Modal) {
    case 'create':
      ajaxRequest("products/create", 'GET', null, function (response) {
        renderModel(response);
        /**
          * Carga los eventos del Modal tanto para cerrarlo como para enviarlo
          */
        addEventListernerModal(function () {
          /**
           * Este codigo se ejecutara cuando el usuario haga click en Enviar
           */
          ajaxRequest("products", 'POST', $("#productForm").serialize(), function (response) {
            /**
             * Una vez enviada la peticion ajax si todo tiene exito copiamos el ultimo tr y 
             * se inserta en la tabla y luego se remplazan los datos con los del nuevo producto creado
             */
            alertify.success(response.message);
            row = $("#productTable tr:last").clone(true, true).appendTo("#productTable");
            updateRow(row, response.date, response.id);

            /**
             * Cierra el modal y desactiva el spinner
             */
            closeModal($('#productModal'));
            ren_spinner(false);
          });


        });
      });
      break;
    case 'edit':
      ajaxRequest("products/" + id + "/edit", 'GET', null, function (response) {

        /**
          * Carga los eventos del Modal tanto para cerrarlo como para enviarlo
          */
        renderModel(response);

        addEventListernerModal(function (response) {
          /**
           * Este codigo se ejecutara cuando el usuario haga click en Enviar
           */
          ajaxRequest("products/" + id, 'PUT', $("#productForm").serialize(), function (response) {
            alertify.success(response.message);
            updateRow(RowClicked);
            closeModal($('#productModal'));
            ren_spinner(false);
          });
        })
      });
      break;
  }


}

/**
 * Genera los eventos para los botones del Modal creado
 * La funcion que se pasa como parametro es llamada cuando el usuario hace click en el boton enviar
 * @param {} submit_Func 
 */

function addEventListernerModal(submit_Func) {
  $("button[name=closeModal]").click(function () {
    closeModal($('#productModal'));
  });

  $("button[name=submitEdit]").click(function () {
    submit_Func();
  });


}
/**
 * Renderiza la respuesta dada por el Controlador de PHP 
 * En este caso renderiza la ventana Model
 * @param {*} response 
 */
function renderModel(response) {
  ren_spinner(false);
  $('body').append(response.html)
  $('#productModal').modal('show');
}

/**
 * Genera una peticion AJAX al servidor
 * 
 * @param {*} url 
 * @param {*} type 
 * @param {*} data 
 * @param {*} success 
 */

function ajaxRequest(url, type, data, success) {
  ren_spinner(true);
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $.ajax(
    {
      url: url,
      type: type,
      dataType: "JSON",
      data: data,
      success: success,
      error: function (xhr) {

        alertify.alert('Error', xhr.responseText)
        closeModal($('#productModal'));
        console.log("---AJAX Error---");
        console.log(xhr.responseText);
        ren_spinner(false);
      }
    });

}