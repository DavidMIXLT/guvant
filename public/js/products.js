/**
  * Variable usada para guardar la ultima columna que el usuario a hecho click
  */
var RowClicked;

/**
 * Ejecutado cuando la pagina acaba de cargar
 */
$(document).ready(function () {
  alertify.set('notifier', 'position', 'top-right');
  loadEvents();
  console.log("----- Products.js Loaded -----");
});

/**
 * Carga los eventos de productos
 */
function loadEvents(){
  $("#MassiveDeleteButton").click(function () {
    massiveElimination();
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

/**
 * Carga los eventos de los Botones de editar y eliminar de la tabla
 */
function loadButtonTableEvents() {
  $("button[name=Delete]").on('click', function () {
    remove($(this).parent().parent().parent().find(".ProductID").text());
    
    RowClicked = $(this).parent().parent().parent();
  });
  $("button[name=Edit]").on('click', function () {
    var url = "products/" +  $(this).parent().parent().parent().find(".ProductID").text() +"/edit";
    renderModal( url,edit);
    RowClicked = $(this).parent().parent().parent();
  });

}

/**
 * CRUD ejecutado para crear un nuevo producto
 */
var submit = function () {

  ajaxRequest("products","POST",$("#modalForm").serialize(),function(response){
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

/**
 * CRUD ejecutado para eliminar producto
 */
var remove = function (id) {
   ajaxRequest("products/" + id, 'DELETE', null, function (response) {
    console.log(response);
    alertify.warning(response.message);
    ren_RemoveRow(RowClicked);
    ren_spinner(false);
  });
};


/**
 * CRUD ejecutado para editar producto
 */
var edit = function(){
  var id = RowClicked.find(".ProductID").text();
  ajaxRequest("products/" + id, 'PUT', $("#modalForm").serialize(), function (response) {
    alertify.success(response.message);
    updateRow(RowClicked);
    closeModal($('#modalBox'));
    ren_spinner(false);
  });
};


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

  $("#idRow").click(function(){
    sortTableInt(1);
  });

  $("#nameRow").click(function(){
    sortTableString(2);
  });
  $("#descriptionRow").click(function(){
    sortTableString(3);
  });
  $("#stockRow").click(function(){
    sortTableInt(4);
  });
  $("#dateRow").click(function(){
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

  ajaxRequest("products/-1", 'delete', ListOfID, function () {

    $(rows).fadeOut("fast", function () {
      ren_RemoveRow(rows);
    });
    alertify.warning(response.message);
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


