//-----------------------------------------------------------------------------------//
/**
 * Variables
 * @var rowClicked  / Sirve para guardar la ultima fila que se ha hecho click
 */
var rowClicked;
//-----------------------------------------------------------------------------------//
var submitCreate = getSubmit("plates", "POST");

/**
 *  Ejecutada cuando la web a terminado de cargar y luego se encarga de cargar los eventos
 */
$(document).ready(function () {

    $("button[name=Create]").click(function () {
        renderModal("plates/create", submitCreate);
    });

    $("#MassiveDeleteButton").click(function () {
        massiveElimination("plates/-1");
    });
    loadEvents();
    console.log("----Plates.js Ready----");
});
//-----------------------------------------------------------------------------------//
/**
 * Carga los eventos o refresca los mismos  de los boton de mostrar,editar y eliminar
 */


 // ------------------------ CRUD ----------------------------
function loadEvents() {

    $(document).on("click","button[name=Show]",function () {
        renderModal("plates/" + $(this).val());
    });
    $(document).on("click","button[name=Edit]",function () {
        var submitEdit = getSubmit("plates/" + $(this).val(), "PUT")
        rowClicked = $(this).parent().parent();
        renderModal("plates/" + $(this).val() + "/edit", submitEdit);
    });
    $(document).on("click","button[name=Delete]",function () {
        remove($(this).val(), $(this).closest('tr'));
    });
}
//-----------------------------------------------------------------------------------//
/**
 * Elimina el plato y envia la peticion por ajax y despues la elimina de la tabla local
 * @param {Id del plato} id 
 * @param {Columna que se ha hecho click} RowClicked 
 */
function remove(id, RowClicked) {

    ajaxRequest("plates/" + id, 'DELETE', null, function (response) {
     
        alertify.warning(response.message);
        ren_RemoveRow(RowClicked);
        ren_spinner(false);
    });
};
//-----------------------------------------------------------------------------------//
/**
 * Funcion utiliza para obtener una funcion anonima con parametros encargada de enviar los submits para el Create y el edit de los platos
 * @param {Url a la que enviar la peticion} url 
 * @param {Metodo de la peticion} method 
 */
function getSubmit(url, method) {
    return function () {
        var ProductList = new Array;
        $('#SelectedList').children().each(function () {
            ProductList.push($(this).val());
        });

        var data = $("#modalForm").serialize() + "&ProductList=" + ProductList;
        console.log(data);

        ajaxRequest(url, method, data, function (response) {
            alertify.success(response.message);
            closeModal($('#modalBox'));
            ren_spinner(false);      
            updateTable(response.html); 
         /*   if (method == "PUT") {
                updateRow(rowClicked, response.html);
            } else {
               
                updateTable(response.html);
                loadEvents();
            }*/
        });

    }
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
    loadEvents();
}
//-----------------------------------------------------------------------------------//



