var id = 1
var Groupid;
var GroupItemsId = [];
$(document).ready(function () {
    alertify.set('notifier', 'position', 'top-right');

    /**
     * Evento ejecutado al hacer clic en el boton create
     */
    $("button[name=Create]").click(function () {
        renderModal("menus/create", submit, null);

    });
    /**
     * Evento ejecutado al hacer clic en el boton delete
     */
    $("button[name=delete]").click(function () {
        renderModal("menus/create");
    });
    /**
     * Evento dentro del modal que hace que se elimine un grupo
     */
    $("tbody").on('click', 'button[name=Delete]', function () {
        remove($(this).parent().parent().parent().find(".Id").text());

    });
    /**
     * 
     */
    $("tbody").on('click', 'button[name=Edit]', function () {
        var url = "menus/" + $(this).parent().parent().parent().find(".Id").text() + "/edit";


    });


    $("#MassiveDeleteButton").click(function () {
        massiveElimination("menus/-1");
    });
    /**
     * Evento boton dentro del modal de crear de Menus encargado de ejecutarse cuando se le da a crear un nuevo grupo
     */
    $(document).on('click', 'button[name=CreateGroup]', function () {
        createGroup();

    })
    /**
     * Evento encargado de editar un grupo cuando se le hace clic
     */
    $(document).on('click', 'button[name=editGroup]', function () {
        EditGroup("#" + $(this).parents().eq(3).attr('id'), false)
    })
    /**
     * Evento encargado de eliminar un grupo cuando se hace clic en eliminar
     */
    $(document).on('click', 'button[name=deleteGroup]', function () {
        deleteGroup("#" + $(this).parents().eq(3).attr('id'), false)
    })

    $(document).on('click', 'button[name=addItems]', function () {
        Groupid = "#" + $(this).closest('div').attr('id');
        renderModal('menus/searchModal', saveItemsSearchModal, null, '#ModalSearch');
        loadIDs(Groupid);
    });

    $(document).on('click', '#Products', function () {
        loadItems('products');

    })
    $(document).on('click', '#Plates', function () {
        loadItems('plates');
    })
    $(document).on('click', 'button[name=back]', function () {
        backButton();
    })

    $(document).on('click','button[name=Edit]',function(){
        var url = 'menus/' + $(this).parents('tr').find('.Id').html() + '/edit';
        console.log(url) 
        renderModal(url);
    });
    console.log("----- Menus.js Loaded -----");


})

function backButton() {
    clearSearchBox();
    $("#menu").removeClass("d-none");
}

function loadItems(url) {
    type = url;
    selectorPagination = "#AvaibleList";
    $('#menu').addClass('d-none');
    ajaxRequest(url, 'GET', null, function (r) {
        ren_spinner(false);
        renderItemsSearchBox(r, url);
    });
}




/**
 * Carga los id del grupo que se le a dado al boton añadir 
 */
function loadIDs(Groupid) {
    GroupItemsId = [];

    $(Groupid + " tbody").children('tr').each(function () {
        var newItem = new Array();
        newItem[0] = $(this).data('id');
        newItem[1] = $(this).data('type')

        GroupItemsId.push(newItem)
    });
    console.log("Ids tabla " + GroupItemsId);
}

/**
 * Carrega
 */
function loadSelectedProducts() {

    /*$(Groupid + " tbody").children('tr').each(function () {
        var id = $(this).data('id');
        var Name = $(this).data('name');
        
        var html = '<li data-id=" ' + id + '" class="list-group-item ">' + Name + '</li>'
    });*/
}

var saveItemsSearchModal = function () {

    $('#SelectedList').children('li').each(function () {
        var id = $(this).data('id');
        var Name = $(this).html();
        var type = $(this).data('type');
        $(Groupid + " tbody").prepend("<tr  data-type='" + type + "' data-id='" + id + "'><td>" + id + "</td><td>" + Name + "</td><td></td></tr>");

    })
    closeModal($('#ModalSearch'));
}

function clearSearchBox() {
    $('#AvaibleList .list-group-item.Item').remove();
    $('.pagination').remove();
}

var type;

function renderItemsSearchBox(response) {
    clearSearchBox();

    for (let index = 0; index < response.items['data'].length; index++) {
        var html = '  <li data-type="' + type + '" data-id="' + response.items['data'][index]['id'] + '" class="list-group-item Item"> ' + response.items['data'][index]['name'] + '  </li>'
        $('#AvaibleList').prepend(html)
    }
    $('#pagination').prepend(response.paginationHTML)
    clearExistingItems();
}

var loadEventSearchBox = function () {





}
var submit = function () {

    var GroupName;
    var Groups = new Array;
    var PlatesID;
    var ProductsID;
    var Menu = new Object();


    $('#accordion').children('.accordion').each(function () {
        GroupName = $(this).find('.btn.btn-link').html().trim();
        PlatesID = new Array;
        ProductsID = new Array;
        var Group = new Object();
        console.log("GroupName " + GroupName);

        $(this).find('tbody').children('tr').each(function () {
            console.log("Hola")
            switch ($(this).data('type')) {
                case "products":
                    ProductsID.push($(this).data('id'));
                    break;

                case "plates":
                    PlatesID.push($(this).data('id'))
                    break;
            }
        });

        Group.name = GroupName.trim();
        Group.PlatesID = PlatesID;
        Group.ProductsID = ProductsID;
        Groups.push(Group);

    });

    Menu.name = $('#name').val();
    console.log($('#name').val())
    Menu.price = $('#price').val();
    Menu.groups = Groups;
    console.log("aaa")
    ajaxRequest('menus','post',JSON.stringify(Menu),function(res){
 
        closeModal($('#modalBox'));
        ren_spinner(false);
        updateTable(res.html)
    });
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

function clearExistingItems() {
    console.log("Limpiar duplicados")
    $('#AvaibleList').children('li').each(function () {
        var item = $(this);
        for (let i = 0; i < GroupItemsId.length; i++) {
            console.log("aaaa")
            console.log(GroupItemsId)
            if (item.data('id') == GroupItemsId[i][0] && item.data('type') == GroupItemsId[i][1]) {

                item.remove();

                return true;
            }
        }
        $('#SelectedList').children('li').each(function () {

            if (item.data('id') == $(this).data('id') && item.data('type') == $(this).data('type')) {
                item.remove();
                return true;
            }
        })
    });
}

/**
 * Encargado de mirar en el searchModal de eliminar de la lista AvaibleItems los items que esten en la lista de SelectedItems
 */
document.addEventListener('ChangePage', function () {
    clearExistingItems();
});


