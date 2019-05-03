$(document).ready(function () {
    console.log("ready")
    $(document).on('click', 'button[name=Create]', function () {
        renderModal('users/create', submit, null);
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