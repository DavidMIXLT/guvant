
var numberOfItems;
var MaxItemsTable = 5;
var animationsDelay = 50;
var animationTimeOut = 50;
var filterActive = false;
var NumberOfModals = 0;
var zIndex = 2000;
var LastModalID;
var selectorPagination = "tbody";
//-----------------------------------------------------------------------------------//

/**
 * Evento que se dispara al canviar de pagina en el paginator
 */
var eventChangePage = document.createEvent('Event');
eventChangePage.initEvent('ChangePage', true, true);


//-----------------------------------------------------------------------------------//
$(document).ready(function () {

    $('#sidebarCollapse').on('click', function () {
        $('#sidebar, #content').toggleClass('active');
        $('.collapse.in').toggleClass('in');
        $('a[aria-expanded=true]').attr('aria-expanded', 'false');
    });

    $(document).on('click', "button[name=closeModal]", function () {

        closeModal($(this).parents().eq(3));
    });

    $("#SelectAll").click(function () {
        selectAll();
    });
    $(document).on("hidden.bs.modal", function () {

        $('.modal-backdrop').css('z-index', 100);
    });


    //-----------------------------------------------------------------------------------//
    if (getCookie("NumberOfItems") > 0) {
        $("#NumberOfElements").val(getCookie("NumberOfItems"));
    } else {
        $("#NumberOfElements").val(5)
    }

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


function PostNumberofItems(number) {
    var data = "NumberOfItems=" + number;
    var url = "./NumberOfItems";

    ajaxRequest(url, "POST", data, function (r) {
        console.log("URL: " + $('.page-link.currentPage').data('href'));
        updatePage($('.page-link.currentPage').data('href'));
        document.cookie = "NumberOfItems=" + number;
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
function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}
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

    console.log("Updating table")
    updateNumberOfRows();
    if (numberOfItems < MaxItemsTable && html != null) {
        $(selectorPagination).append(html);
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


function changePageTable(url, selector) {


    EmptyContent();
    ajaxRequest(url, 'GET', null, function (res) {
        if (selectorPagination == "#AvaibleList") {
            renderItemsSearchBox(res);
        } else {
            emptyTable();
            $(selectorPagination).append(res.html);
        }
        updatePaginationLinks(res.paginationHTML);
        fadeInAll();
        ren_spinner(false);
        document.dispatchEvent(eventChangePage);
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
    if (selectorPagination == 'tbody') {

        $('ProductID').html('');
        $('ProductName').html('');
        $('ProductDescription').html('');
        $('ProductDate').html('');
    }
}


/**
 * Obtiene el html de la paginacion
 */
function getPaginationLinks() {
    console.log("AAAAAAAAAAAAAAAAAAAAAAAAAa")
    numberOfItems = $('tr').length - 1;
    ajaxRequest('./pagination', 'GET', null, function (res) {
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


function renderModal(url, submit_Func, success_func, id) {

    if (id === undefined) {
        id = "#modalBox";
    }

    ajaxRequest(url, "GET", null, function (response) {
        NumberOfModals++;
        console.log("Numero de modals " + NumberOfModals);
        LastModalID = id;

        $("body").append(response.html);
        console.log(id)
        $(id).modal("show");
        ren_spinner(false);

        if (NumberOfModals > 1) {
            zIndex += 10;
            $('.modal-backdrop').first().css('z-index', zIndex);
            $(id).css('z-index', zIndex + 10);
        }
        if (success_func != null) {
            success_func(response);
        }

        addEventListernerModal(submit_Func);
    });
}
//-----------------------------------------------------------------------------------//
/**
 * Obtiene todos los IDS de los checkbox selecionados
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
            alertify.alert("Error", "<pre style='height:400px'>" + xhr.responseText + "</pre>");
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
    $("button[name=submitEdit]").click(function () {
        console.log("Sending")
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

    Modal.find('.modal-backdrop ')
    setTimeout(() => {
        Modal.remove();
    }, 1000);
    NumberOfModals--;
    console.log("Numero de modals CLOSE " + NumberOfModals);
    if (NumberOfModals == 0) {
        $('body').removeClass('modal-open');
        $('body').removeAttr("style");
    }


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
