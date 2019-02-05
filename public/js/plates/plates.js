//-----------------------------------------------------------------------------------//
/**
 * Variables
 * @var rowClicked  / Sirve para guardar la ultima fila que se ha hecho click
 */
var rowClicked;
//-----------------------------------------------------------------------------------//
var submitCreate = getSubmit("plates", "POST");
/**
 * Variable que guarda una funcion anonima encargada de la interactividad de lista de productos dentro de los formularios de 
 * crear y editar.
 */
var onLoadModal = function () {
    $('.productItem').click(function () {
      
        if ($(this).parent().attr('id') == "ProductList") {
            $(this).appendTo("#SelectedProducts");
        } else {
            $(this).appendTo("#ProductList");
        }
    });
}
//-----------------------------------------------------------------------------------//
/**
 *  Ejecutada cuando la web a terminado de cargar y luego se encarga de cargar los eventos
 */
$(document).ready(function () {

    $("button[name=Create]").click(function () {
        renderModal("plates/create", submitCreate, onLoadModal);
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
function loadEvents() {

    $("button[name=Show]").click(function () {
        renderModal("plates/" + $(this).val());
    });
    $("button[name=Edit]").click(function () {
        var submitEdit = getSubmit("plates/" + $(this).val(), "PUT")
        rowClicked = $(this).parent().parent();
        renderModal("plates/" + $(this).val() + "/edit", submitEdit, onLoadModal);
    });
    $("button[name=Delete]").click(function () {
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
        $('#SelectedProducts').children().each(function () {
            ProductList.push($(this).val());
        });

        var data = $("#modalForm").serialize() + "&ProductList=" + ProductList;
        console.log(data);

        ajaxRequest(url, method, data, function (response) {
            alertify.success(response.message);
            closeModal($('#modalBox'));
            ren_spinner(false);       
            if (method == "PUT") {
                updateRow(rowClicked, response.html);
            } else {
                $("tbody").append(response.html)
                loadEvents();
            }
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



