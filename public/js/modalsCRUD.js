
var numberOfItems;
var MaxItemsTable = 5;
var animationsDelay = 50;
var animationTimeOut = 50;
var filterActive = false;

//-----------------------------------------------------------------------------------//
$(document).ready(function () {
    $("#SelectAll").click(function () {
        selectAll();
    });
    $(document).on("hidden.bs.modal", function () {
        $("#modalBox").remove();
    });


    //-----------------------------------------------------------------------------------//

    $(document).on("click", ".Item", function () {
        console.log(
            $(this)
                .parent()
                .attr("id")
        );
        if (
            $(this)
                .parent()
                .attr("id") == "AvaibleList"
        ) {
            $(this).appendTo("#SelectedList");
        } else {
            $(this).appendTo("#AvaibleList");
        }
    });
    $("#NumberOfElements").change(function () {
        MaxItemsTable = $(this).val();

        PostNumberofItems(MaxItemsTable);
      
    });
    //-----------------------------------------------------------------------------------//
    $(document).on('click', '.page-link', function () {

        //Comprovamos si hay algun fitlro en la tabla activo
        updatePage($(this).data('href'))

    })
    numberOfItems = $('tr').length - 1;

    // Ejecutamos fadeInall() para mostrar la animacion de todos los productos de la tabla
    fadeInAll();
});


function PostNumberofItems(number){
    var data = "NumberOfItems="+number ;
    var url = window.location.href + "/NumberOfItems";
    console.log(url);
    ajaxRequest(url,"POST",data,function(r){
        updatePage($('.page-link currentPage').data('href'));
        console.log(r.message)
    });
}
function updatePage(url) {
    if (!filterActive) {
        console.log("CHANGE")
        changePageTable(url);

    } else {
        console.log("POST")
        postCategoryList(url, getDataCategories());
    }
    console.log(url)
}
//-----------------------------------------------------------------------------------//
/**
 * 
 * Animations
 */
//-----------------------------------------------------------------------------------//

function fadeInAll() {
    var offset = 0;
    $('.DataRow').each(function () {
        var row = $(this);
        setTimeout(function () {
            row.removeClass('invisible')
            row.addClass('fadeInLeft');
        }, animationTimeOut + offset);

        offset += animationsDelay;
    });

}
function fadeInLeft(row) {
    console.log(row)
    row.removeClass('invisible')
    row.addClass('fadeInLeft');
}

function fadeInLeftStop(DataRow) {
    DataRow.removeClass('fadeInLeft');


}

//-----------------------------------------------------------------------------------//

/**
 * End Animations
 */

//-----------------------------------------------------------------------------------//

//-----------------------------------------------------------------------------------//
/**
 * 
 * Pagination functions
 */

//-----------------------------------------------------------------------------------//
/**
 * Funcion que actualiza la variable que contiene el numero de filas que tiene la tabla 
 */
function updateNumberOfRows() {
    numberOfItems = $('tr').length - 1;
}

/**
 * Funcion encargada de tomar la accion correspondiente sobre la tabla
 * principalmente se encarga de actualizar el contenido interior
 * @param {Filas que envia el servidor} html 
 */
function updateTable(html) {
    updateNumberOfRows();
    if (numberOfItems < MaxItemsTable && html != null) {
        $("tbody").append(html);
        fadeInAll();
    } else if (numberOfItems >= 5) {
        nextPage();
    } else if (numberOfItems == 0) {
        previusPage();
    } else if (numberOfItems < 5) {
        console.log("UPDATE")
        changePageTable($('.currentPage').data('href'));
    }
    updateNumberOfRows();

}

/**
 * Canvia la pagina de la tabla
 * @param {URL para obtener los items de la nueva pagina} url 
 */
function changePageTable(url) {

    EmptyContent();
    ajaxRequest(url, 'GET', null, function (res) {
        emptyTable();
        $("tbody").append(res.html);
        updatePaginationLinks(res.paginationHTML);
        fadeInAll();
        ren_spinner(false);
    });
}



/**
 * Vacia la tabla y solo deja la cabezera
 */
function emptyTable() {
    $('tr:gt(0)').remove()

}

/**
 * Actualiza los links de la paginacion 
 * @param {HTML con los links de paginacion} html 
 */
function updatePaginationLinks(html) {
    console.log("Actualizado links")
    numberOfItems = $('tr').length - 1;
    $('.pagination').empty();
    $('.pagination').append(html).fadeIn(999);

}

/**
 * Canvia a la siguiente pagina de la tabla
 */

function nextPage() {
    console.log("NextPage")
    changePageTable($('.page-link.next').data('href'));

}
/**
 * Canvia a la pagina anterior de la tabla
 */
function previusPage() {
    console.log("Previus page")
    var href = $('.page-link.last').data('href');
    console.log(href)
    if (href != "unique") {
        changePageTable(href);
    }

}
/**
 * Vacia todo el contenido de las filas de la tabla
 */
function EmptyContent() {
    $('ProductID').html('');
    $('ProductName').html('');
    $('ProductDescription').html('');
    $('ProductDate').html('');
}


/**
 * Obtiene el html de la paginacion
 */
function getPaginationLinks() {
    numberOfItems = $('tr').length - 1;
    ajaxRequest('products/pagination', 'GET', null, function (res) {
        updatePaginationLinks(res.paginationHTML)
    });

}

//-----------------------------------------------------------------------------------//

/**
 * 
 * End Pagination functions
 */

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
        $("body").append(response.html);
        $("#modalBox").modal("show");
        ren_spinner(false);

        if (success_func != null) {
            success_func(response);
        }

        addEventListernerModal(submit_Func);
    });
}
//-----------------------------------------------------------------------------------//
/**
 * Obtiene todos los IDS de los checkbox selecionados en productos.index
 *
 * @return Response AJAX
 */
function massiveElimination(url) {
    var ListOfID = new Array();
    var rows = $(
        "input[type=checkbox][name=checkBoxActionDelete]:checked"
    ).parents("tr");

    $("input[type=checkbox][name=checkBoxActionDelete]:checked").each(
        function () {
            ListOfID.push($(this).val());
        }
    );
    var data = '{"listofid" : ' + JSON.stringify(ListOfID) + "}";
    console.log(data);

    ajaxRequest(url, "post", data, function (response) {
        ren_RemoveRow(rows);
        $(rows).fadeOut("fast", function () {

        });
        alertify.warning(response.message);
        ren_spinner(false);
    });
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
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        }
    });
    $.ajax({
        url: url,
        type: type,
        dataType: "JSON",
        data: data,
        success: success,
        error: function (xhr) {
            alertify.alert("Error", xhr.responseText);
            closeModal($("#modalBox"));
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
        closeModal($("#modalBox"));
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
    Modal.modal("hide");
    Modal.remove();
    $('body').removeClass('modal-open');
    $('body').removeAttr("style");
    $('.modal-backdrop').remove();
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
    updateTable();
    updateNumberOfRows();

}
//-----------------------------------------------------------------------------------//
/**
 * Selecciona todas las checkbox
 */
function selectAll() {
    $("input[type=checkbox]").each(function () {
        $(this).prop("checked", true);
    });
}
//-----------------------------------------------------------------------------------//
