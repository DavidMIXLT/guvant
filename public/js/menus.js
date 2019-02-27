var id = 1

$(document).ready(function () {
    alertify.set('notifier', 'position', 'top-right');


    $("button[name=Create]").click(function () {
        renderModal("menus/create", submit);
    });

    $("button[name=delete]").click(function () {
        renderModal("menus/create");
    });
    $(document).on('click', 'button[name=Delete]', function () {
        remove($(this).parent().parent().parent().find(".Id").text());

    });
    $(document).on('click', 'button[name=Edit]', function () {
        var url = "menus/" + $(this).parent().parent().parent().find(".Id").text() + "/edit";
        console.log(url);

    });
  

    $("#MassiveDeleteButton").click(function () {
        massiveElimination("menus/-1");
    });

    $(document).on('click', 'button[name=CreateGroup]', function () {
        createGroup();
    })
    $(document).on('click', 'button[name=editGroup]', function () {
        EditGroup( "#"+ $(this).parents().eq(3).attr('id'),false)
    })
    $(document).on('click', 'button[name=deleteGroup]', function () {
        deleteGroup( "#"+ $(this).parents().eq(3).attr('id'),false)
    })

    console.log("----- Menus.js Loaded -----");


})

var submit = function () {

}

function EndEditGroup(id) {
    $(id).find('.collapseButton').html($(id).find('input').val());
    $(id).find('.edit').addClass('d-none');
    $(id).find('.noEdit').removeClass('d-none');
}

function EditGroup(id,newGroup = true) {
    console.log(id)
    EditingGroup = true;
    if(newGroup){
        $(id).find('input').focus().val('');
    }
    $(id).find('.edit').removeClass('d-none');
    $(id).find('.noEdit').addClass('d-none');
    $(id).find('button[name=send]').click(function(){
        EndEditGroup(id)
        console.log($(id))
    });
    

}


function deleteGroup(id){
    $(id).remove();
}
function createGroup() {

    id++;
    var data = "id=" + id;
    ajaxRequest('menus/newGroup', 'POST', data, function (res) {
        $('#accordion').append(res.html);
        EditGroup("#accordion" + id);
        ren_spinner(false);
    });
}

function remove(id) {
    ajaxRequest("menus/" + id, "DELETE", null, function (res) {
        alertify.success(res.message);
        updateTable();
        ren_spinner(false);
    });
}

