//-----------------------------------------------------------------------------------//
/**
  * Variable usada para guardar la ultima columna que el usuario a hecho click
  */
var RowClicked;
//-----------------------------------------------------------------------------------//
/**
 * Ejecutado cuando la pagina acaba de cargar
 */
$(document).ready(function () {
  alertify.set('notifier', 'position', 'top-right');
  loadEvents();
  console.log("----- Products.js Loaded -----");
});
//-----------------------------------------------------------------------------------//
/**
 * Carga los eventos de productos
 */
function loadEvents() {
  $("#MassiveDeleteButton").click(function () {
    massiveElimination("products/masDel");
  });

  $("#SelectAll").click(function () {
    selectAll();
  });

  $("button[name=Create]").click(function () {
    renderModal("products/create", submit);
  });
  loadTableSortEvents();
  loadButtonTableEvents();
}
//-----------------------------------------------------------------------------------\\
/**
 * Carga los eventos de los Botones de editar y eliminar de la tabla
 */
function loadButtonTableEvents() {
  $(document).on('click','button[name=Delete]', function () {
    remove($(this).parent().parent().parent().find(".ProductID").text());

    RowClicked = $(this).parent().parent().parent();
  });
  $(document).on('click','button[name=Edit]', function () {
    var url = "products/" + $(this).parent().parent().parent().find(".ProductID").text() + "/edit";
    renderModal(url, edit);

    RowClicked = $(this).parent().parent().parent();
  });

}
//-----------------------------------------------------------------------------------//
/**
 * CRUD ejecutado para crear un nuevo producto
 */

 
var submit = function () {
  ajaxRequest("products", "POST", serializeForm(), function (response) {
    alertify.success(response.message);


    $("tbody").append(response.html)

    /**
     * Cierra el modal y desactiva el spinner
     */
    closeModal($('#modalBox'));
    ren_spinner(false);
  });

};
//-----------------------------------------------------------------------------------//

function serializeForm(){
  var CategoryList = new Array;
  $('#SelectedList').children().each(function () {
    CategoryList.push($(this).val());
  });
  var data = $("#modalForm").serialize() + "&CategoryList=" + CategoryList;
  return data;
}
/**
 * CRUD ejecutado para eliminar producto
 */
var remove = function (id) {

  var ListOfID = new Array();
  ListOfID.push(id);
  console.log(ListOfID);
  ajaxRequest("products/" + id, 'DELETE', null, function (response) {
    console.log(response);
    alertify.warning(response.message);
    ren_RemoveRow(RowClicked);
    ren_spinner(false);
  });
};

//-----------------------------------------------------------------------------------//
/**
 * CRUD ejecutado para editar producto
 */
var edit = function () {
  var id = RowClicked.find(".ProductID").text();
  ajaxRequest("products/" + id, 'PUT', serializeForm(), function (response) {
    alertify.success(response.message);
    updateRow(RowClicked,response.html);
    closeModal($('#modalBox'));
    ren_spinner(false);
  });
};
//-----------------------------------------------------------------------------------//

/**
  * Carga los eventos para ordenar la tabla al pulsar en las cabecera
  */
function loadTableSortEvents() {

  $("#idRow").click(function () {
    sortTableInt(1);
  });

  $("#nameRow").click(function () {
    sortTableString(2);
  });
  $("#descriptionRow").click(function () {
    sortTableString(3);
  });
  $("#stockRow").click(function () {
    sortTableInt(4);
  });
  $("#dateRow").click(function () {
    sortTableDate(5);
  });

}


//-----------------------------------------------------------------------------------//
/**
  * Actualiza las columnas con los nuevos datos
  *  @param OldRow Columna actual renderiza en la tabla
  *  @param newRow Nueva columna con los datos actualizados
  */
 function updateRow(OldRow, newRow) {
  $(newRow).insertBefore(OldRow);
  OldRow.remove();

}
//-----------------------------------------------------------------------------------//



