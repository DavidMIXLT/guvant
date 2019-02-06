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
    massiveElimination("products/-1");
  });

  $("#SelectAll").click(function () {
    selectAll();
  });

  $("button[name=Create]").click(function () {
    renderModal("products/create", submit, loadEventsNavSelectionBox);
  });
  loadTableSortEvents();
  loadButtonTableEvents();
}
//-----------------------------------------------------------------------------------\\
/**
 * Carga los eventos de los Botones de editar y eliminar de la tabla
 */
function loadButtonTableEvents() {
  $("button[name=Delete]").on('click', function () {
    remove($(this).parent().parent().parent().find(".ProductID").text());

    RowClicked = $(this).parent().parent().parent();
  });
  $("button[name=Edit]").on('click', function () {
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
  var CategoryList = new Array;
  $('#SelectedList').children().each(function () {
    CategoryList.push($(this).val());
  });
  var data = $("#modalForm").serialize() + "&CategoryList=" + CategoryList;
  ajaxRequest("products", "POST", data, function (response) {
    alertify.success(response.message);
    row = $("#productTable tr:last").clone(true, true).appendTo("#productTable");

    updateRow(row, response.date, response.id);

    /**
     * Cierra el modal y desactiva el spinner
     */
    closeModal($('#modalBox'));
    ren_spinner(false);
  });

};
//-----------------------------------------------------------------------------------//
/**
 * CRUD ejecutado para eliminar producto
 */
var remove = function (id) {

  var ListOfID = new Array();
  ListOfID.push(id);
  ajaxRequest("products/" + id, 'DELETE', ListOfID, function (response) {
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
  ajaxRequest("products/" + id, 'PUT', $("#modalForm").serialize(), function (response) {
    alertify.success(response.message);
    updateRow(RowClicked);
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


