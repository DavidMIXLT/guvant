
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


function renderModal(url, submit_Func,success_func) {

    ajaxRequest(url, "GET", null, function (response) {
        $('body').append(response.html)
        $('#modalBox').modal('show');
      
        success_func();
        addEventListernerModal(submit_Func);
    })

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
                closeModal($('#modalBox'));
                console.log("---AJAX Error---");
                console.log(xhr.responseText);
                ren_spinner(false);
            }
        });

}


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

/**
  * Cierra la ventana Model y la elimina
  *  @param Modal modal
  */
 function closeModal(Modal) {
    Modal.modal('hide');
    Modal.remove();
  }