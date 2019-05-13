var lastID = -1;
$(document).ready(function () {
    console.log("ready")
    $(document).on('click', 'button[name=Create]', function () {
        renderModal('users/create', submit, null);
    })
    $(document).on('click', 'button[name=Edit]', function () {
        lastID = $(this).data('id');
        renderModal('users/' + lastID + '/edit', edit, null);
    })
    $(document).on('click', 'button[name=Delete]', function () {
        lastID = $(this).data('id');
        remove(lastID);
        $(this).parent().parent().remove()
    })
})


var submit = function(){
    ajaxRequest("users", "POST", $("#modalForm").serialize(), function (response) {
        alertify.success(response.message);
        closeModal($('#modalBox'));
     
        updateTable(response.html);
        ren_spinner(false);
      
    });
}

 var edit = function() {
    ajaxRequest("users/" + lastID + "", "PUT", $("#modalForm").serialize(), function (response) {
        alertify.success(response.message);
        closeModal($('#modalBox'));
     
        updateTable(response.html);
        ren_spinner(false);
      
    });
}

function remove(id) {
    ajaxRequest("users/" + id, 'DELETE', null, function (response) {
        alertify.warning(response.message);
        ren_spinner(false);
   
    });
}