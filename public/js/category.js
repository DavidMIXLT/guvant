//-----------------------------------------------------------------------------------//
/**
 *  Ejecutada cuando la web a terminado de cargar y luego se encarga de cargar los eventos
 */
$(document).ready(function () {

    $("button[name=Create]").click(function () {
        renderModal("categories/create", submitCreate, null);
    });

    $("#MassiveDeleteButton").click(function () {
        massiveElimination("categories/-1");
    });
    loadEvents();
    console.log("----Category.js Ready----");
});

function loadEvents(){
    $("button[name=Delete]").click(function () {
        remove($(this).val(), $(this).closest('tr'));
    });
}


var submitCreate = function(){
    ajaxRequest("categories","POST",$("#modalForm").serialize(),function(response){
            alertify.success(response.message);
            closeModal($('#modalBox'));
            $("tbody").append(response.html);
            ren_spinner(false);
    });
}


function remove(){
    ajaxRequest("categories/" + id, 'DELETE', null, function (response) {
     
        alertify.warning(response.message);
        ren_RemoveRow(RowClicked);
        ren_spinner(false);
    });
}


