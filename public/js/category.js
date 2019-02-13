//-----------------------------------------------------------------------------------//
/**
 *  Ejecutada cuando la web a terminado de cargar y luego se encarga de cargar los eventos
 */
$(document).ready(function () {

    $("button[name=Create]").click(function () {
        renderModal("categories/create", submit, null);
    });

    $("#MassiveDeleteButton").click(function () {
        massiveElimination("categories/-1");
    });
    loadEvents();
    console.log("----Category.js Ready----");
});

function loadEvents() {
    $(document).on('click','button[name=Delete]',function(){
        remove($(this).val(), $(this).closest('tr'));
    });
    $(document).on('click','button[name=Edit]',function(){
        renderModal("categories/edit", getEdit($(this).val()), null);
    });

}

function getEdit(id){

    return function(){
        ajaxRequest("categories/" + id +"/edit", "POST", $("#modalForm").serialize(), function (response) {
            alertify.success(response.message);
            closeModal($('#modalBox'));
            ren_spinner(false);
           
        });
    }
}

var submit = function () {
    ajaxRequest("categories", "POST", $("#modalForm").serialize(), function (response) {
        alertify.success(response.message);
        closeModal($('#modalBox'));
        $("tbody").append(response.html);
        ren_spinner(false);
      
    });
}


function remove(id, RowClicked) {
    ajaxRequest("categories/" + id, 'DELETE', null, function (response) {
        alertify.warning(response.message);
        ren_RemoveRow(RowClicked);
        ren_spinner(false);
   
    });
}


