
$(document).ready(function () {
    $("#SelectAll").click(function () {
        selectAll();
    });
    $(document).on('hidden.bs.modal', function () {

        $("#modalBox").remove();
    });
});
//-----------------------------------------------------------------------------------//
/**
 * Variable que guarda una funcion anonima encargada de la interactividad de lista una lista con dos columnas
 */
var loadEventsNavSelectionBox = function () {
    $('.Item').click(function () {
      console.log($(this).parent().attr('id') );
        if ($(this).parent().attr('id') == "AvaibleList") {
            $(this).appendTo("#SelectedList");
        } else {
            $(this).appendTo("#AvaibleList");
            
        }
    });
}

//-----------------------------------------------------------------------------------//
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
//-----------------------------------------------------------------------------------//
/**
 * Renderiza el Modal
 * @param {Url de la peticion} url 
 * @param {Funcion ejecutada al hacer click en submit} submit_Func 
 * @param {Funcion ejecutada cuando el Modal a sido renderizado} success_func 
 */

function renderModal(url, submit_Func, success_func) {
    ajaxRequest(url, "GET", null, function (response) {
        $('body').append(response.html)
        $('#modalBox').modal('show');
        ren_spinner(false);
        console.log(response.message)
        if (success_func != null) { success_func(response); };

        addEventListernerModal(submit_Func);
    })

}
//-----------------------------------------------------------------------------------//
/**
  * Obtiene todos los IDS de los checkbox selecionados en productos.index
  *
  * @return Response AJAX
  */
function massiveElimination(url) {

    var ListOfID = new Array();
    var rows = $("input[type=checkbox][name=checkBoxActionDelete]:checked").parents("tr");

    $("input[type=checkbox][name=checkBoxActionDelete]:checked").each(function () {
        ListOfID.push($(this).val())
    });

    ajaxRequest(url, 'delete', ListOfID, function (response) {

        $(rows).fadeOut("fast", function () {
            ren_RemoveRow(rows);
        });
        alertify.warning(response.message);
        ren_spinner(false);

    })
}
//-----------------------------------------------------------------------------------//

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
                closeModal($('#modalBox'));
                console.log("---AJAX Error---");
                console.log(xhr.responseText);
                ren_spinner(false);
            }
        });

}
//-----------------------------------------------------------------------------------//

/**
 * Genera los eventos para los botones del Modal creado
 * La funcion que se pasa como parametro es llamada cuando el usuario hace click en el boton enviar
 * @param {} submit_Func 
 */

function addEventListernerModal(submit_Func) {
    $("button[name=closeModal]").click(function () {
        closeModal($('#modalBox'));
    });

    $("button[name=submitEdit]").click(function () {
        submit_Func();
    });


}
//-----------------------------------------------------------------------------------//
/**
  * Cierra la ventana Model y la elimina
  *  @param Modal modal
  */
function closeModal(Modal) {
    Modal.modal('hide');
    Modal.remove();
}
//-----------------------------------------------------------------------------------//
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
//-----------------------------------------------------------------------------------//
/**
* Selecciona todas las checkbox
*/
function selectAll() {
    $("input[type=checkbox]").each(function () {
        $(this).prop('checked', true);
    });
}
//-----------------------------------------------------------------------------------//