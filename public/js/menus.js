var id = 1
var Groupid;
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
        EditGroup("#" + $(this).parents().eq(3).attr('id'), false)
    })
    $(document).on('click', 'button[name=deleteGroup]', function () {
        deleteGroup("#" + $(this).parents().eq(3).attr('id'), false)
    })

    $(document).on('click', 'button[name=addItems]', function () {
        Groupid = "#" + $(this).closest('div').attr('id');
        console.log(Groupid)
        renderModal('menus/searchModal', saveItemsSearchModal, loadEventSearchBox, '#ModalSearch');
    });

    console.log("----- Menus.js Loaded -----");


})
/**
 * Carrega
 */
function loadSelectedProducts() {
    $(Groupid + " tbody").children('tr').each(function () {
        var id = $(this).data('id');
        var Name = $(this).data('name');
        var html = '<li data-id=" ' + id + '" class="list-group-item ">'+Name+'</li>'
    });
}

var saveItemsSearchModal = function () {

    $('#SelectedList').children('li').each(function () {
        var id = $(this).data('id');
        var Name = $(this).html();

        $(Groupid + " tbody").append("<tr data-id='" + id + "'><td>" + id + "</td><td>" + Name + "</td><td></td></tr>");
    })
}

function clearSearchBox() {
    $('#AvaibleList .list-group-item.Item').remove();
    $('.pagination').remove();
}

function renderItemsSearchBox(response) {
    clearSearchBox();
    for (let index = 0; index < response.products['data'].length; index++) {
        var html = '  <li data-id="' + response.products['data'][index]['id'] + '" class="list-group-item Item"> ' + response.products['data'][index]['name'] + '  </li>'
        $('#AvaibleList').append(html)
    }
    $('#AvaibleList').append(response.paginationHTML)
}
var loadEventSearchBox = function () {

    $('#Products').click(function () {
        selectorPagination = "#AvaibleList";
        $('#menu').addClass('d-none');
        ajaxRequest('products', 'GET', null, function (r) {
            ren_spinner(false);
            renderItemsSearchBox(r);
        });
    })



}
var submit = function () {

}

function EndEditGroup(id) {
    $(id).find('.collapseButton').html($(id).find('input').val());
    $(id).find('.edit').addClass('d-none');
    $(id).find('.noEdit').removeClass('d-none');
}

function EditGroup(id, newGroup = true) {
    console.log(id)
    EditingGroup = true;
    if (newGroup) {
        $(id).find('input').focus().val('');
    }
    $(id).find('.edit').removeClass('d-none');
    $(id).find('.noEdit').addClass('d-none');
    $(id).find('button[name=send]').click(function () {
        EndEditGroup(id)
        console.log($(id))
    });



}


function deleteGroup(id) {
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
/**
 * Encargado de mirar en el searchModal de eliminar de la lista AvaibleItems los items que esten en la lista de SelectedItems
 */
document.addEventListener('ChangePage', function () {

    $('#AvaibleList').children('li').each(function () {
        var item = $(this);
        $('#SelectedList').children('li').each(function () {
            if (item.data('id') == $(this).data('id')) {
                item.remove();
                return true;
            }
        })



    });
});