//Id que se va incrementando para los nuevos grupos
var id = 1
//Se guarda el id del ultimo grupo que se ha seleccionado
var idSelectedMenu;
//Se guarda el ultimo id del grupo seleccionado
var Groupid;

//-----------------------------------------------------------------------------------//
/**
  * Variable usada para guardar la ultima columna que el usuario a hecho click
  */
var RowClicked;
//-----------------------------------------------------------------------------------//

$(document).ready(function () {
   
    $("#MassiveDeleteButton").click(function () {
        massiveElimination("menus/-1");
    });

    $(document).on('click', 'button[name=addItems]', function () {
        Groupid = "#" + $(this).closest('div').attr('id');
        renderModal('menus/searchModal', saveItemsSearchModal, null, '#ModalSearch');
        loadIDs(Groupid);
    });
    //----------------------------------------------------------------------------\\
    /**
     * Eventos de dentro de modalSearch
     */

    //Ejecutado al hacer clic en productos
    $(document).on('click', '#Products', function () {
        loadItems('products');

    })
    //Ejecutado al hacer clic en platos
    $(document).on('click', '#Plates', function () {
        loadItems('plates');
    })
    //Ejecutado al hacer clic
    $(document).on('click', 'button[name=back]', function () {
        backButton();
    })

    //----------------------------------------------------------------------------\\
    /**
     * Eventos CRUD -- Modelo: Menu 
     */

    /**
     * EDIT --- Evento ejecutado al hacer clic en el boton delete
     */
    $(document).on('click', 'button[name=Edit]', function () {
        var url = 'menus/' + $(this).parents('tr').find('.Id').html() + '/edit';
        RowClicked = $(this).parents('tr');
        id = $(this).parents('tr').find('.Id').html();
        idSelectedMenu = id;
        renderModal(url, edit);
    });
    /**
    * CREATE --- Evento ejecutado al hacer clic en el boton create
    */
    $("button[name=Create]").click(function () {
        renderModal("menus/create", submit, null);

    });
    /**
     * DELETE --- Evento ejecutado al hacer clic en el boton delete de la tabla
     */
    $("tbody").on('click', 'button[name=Delete]', function () {
        remove($(this).parent().parent().parent().find(".Id").text());

    });
    //----------------------------------------------------------------------------\\
    /**
     * Eventos CRUD -- Modelo: Group
     */

    /**
     * CREATE --- Evento boton dentro del modal de crear de Menus encargado 
     *            de ejecutarse cuando se le da a crear un nuevo grupo
     */
    $(document).on('click', 'button[name=CreateGroup]', function () {
        createGroup();

    })

    /**
     * EDIT --- Evento encargado de editar un grupo cuando se le hace clic
     */
    $(document).on('click', 'button[name=editGroup]', function () {
        EditGroup("#" + $(this).parents().eq(3).attr('id'), false)
    })

    /**
     * DELETE --- Evento encargado de eliminar un grupo cuando se hace clic en eliminar
     */
    $(document).on('click', 'button[name=deleteGroup]', function () {
        deleteGroup("#" + $(this).parents().eq(3).attr('id'), false)
    })

    /**
     * Evento encargado de eliminar un item de dentro de un grupo
     */
    $(document).on('click','button[name=DeleteGroupItem]',function(){
        $(this).closest("tr").remove();
      
    });
    //----------------------------------------------------------------------------\\
    console.log("----- Menus.js Loaded -----");
})

//----------------------------------------------------------------------------\\
/**
 *  -----------------------CRUD-----------------------
 */

var edit = function () {

    var Menu = modalGetData();
    ajaxRequest('menus/' + idSelectedMenu, 'PUT', JSON.stringify(Menu), function (res) {

        closeModal($('#modalBox'));
        ren_spinner(false);
        alertify.warning(res.message);
        updateRow(RowClicked, res.html);
    });

}


var submit = function () {


    var menu = modalGetData();
    ajaxRequest('menus', 'post', JSON.stringify(menu), function (res) {
        alertify.success(res.message);
        closeModal($('#modalBox'));
        ren_spinner(false);
        updateTable(res.html)
    });
}

function remove(id) {
    ajaxRequest("menus/" + id, "DELETE", null, function (res) {
        alertify.success(res.message);
        updateTable();
        ren_spinner(false);
    });
}
//----------------------------------------------------------------------------\\


/**
 * Boton dentro de Modal Search para poder retroceder a la selecion de Productos y latos
 */
function backButton() {
    clearSearchBox();
    $("#menu").removeClass("d-none");
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
/**
 * Funcion usada para cuando el usuario acabado de seleccionar los productos/platos guardarlos en la tabla del grupo
 */
var saveItemsSearchModal = function () {

    $('#SelectedList').children('li').each(function () {
        var id = $(this).data('id');
        var Name = $(this).html();
        var type = $(this).data('type');
        $(Groupid + " tbody").prepend("<tr  data-type='" + type + "' data-id='" + id + "'><td>" + id + "</td><td>" + Name + '</td><td><button name="DeleteGroupItem" class="btn btn-danger btn-light-warning">X</button></td></tr>');

    })
    closeModal($('#ModalSearch'));
}
/**
 * Limpia todos los items de la SearchBox
 */
function clearSearchBox() {
    $('#AvaibleList .list-group-item.Item').remove();
    $('.pagination').remove();
}



/**
 * Funcion que serializa toda la informacion y la transforma en JSON para ser enviada
 */
function modalGetData() {
    var GroupName;
    var Groups = new Array;
    var PlatesID;
    var ProductsID;
    var GroupID;
    var Menu = new Object();
    var id;

    $('#accordion').children('.accordion').each(function () {
        GroupName = $(this).find('.btn.btn-link').html().trim();
        PlatesID = new Array;
        ProductsID = new Array;
        GroupID = $(this).data('groupid');
        var Group = new Object();

        $(this).find('tbody').children('tr').each(function () {
    
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
        Group.GroupID = GroupID;
        Groups.push(Group);

    });

    Menu.name = $('#name').val();

    Menu.price = $('#price').val();
    Menu.groups = Groups;

    return Menu
}
/**
 * Funcion ejecutada cuando el usuario hace clic en el boton de finalizar un grupo
 * @param {*} id 
 */
function EndEditGroup(id) {
    $(id).find('.collapseButton').html($(id).find('input').val());
    $(id).find('.edit').addClass('d-none');
    $(id).find('.noEdit').removeClass('d-none');
}
/**
 * Funcion que sirve para editar el nombre de un grupo
 * @param {*} id 
 * @param {*} newGroup 
 */
function EditGroup(id, newGroup = true) {
    EditingGroup = true;
    if (newGroup) {
        $(id).find('input').focus().val('');
    }
    $(id).find('.edit').removeClass('d-none');
    $(id).find('.noEdit').addClass('d-none');
    $(id).find('button[name=send]').click(function () {
        EndEditGroup(id)
    });



}

/**
 * Elimina el grupo correspondiente 
 * @param {*} id 
 */
function deleteGroup(id) {
    $(id).remove();
}
/**
 * Crea un nuevo grupo y activa su edicion 
 */
function createGroup() {

    id++;
    var data = "id=" + id;
    ajaxRequest('menus/newGroup', 'POST', data, function (res) {
        $('#accordion').append(res.html);
        EditGroup("#accordion" + id);
        ren_spinner(false);
    });
}




/**
 * Encargado de mirar en el searchModal de eliminar de la lista AvaibleItems los items que esten en la lista de SelectedItems
 */
document.addEventListener('ChangePage', function () {
    clearExistingItems();
});


