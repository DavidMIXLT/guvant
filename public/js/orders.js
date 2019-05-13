let RowClicked;
let numOrder = -1;
let lastOrder
let interval;
$(document).ready(function () {
    lastOrder = $('meta[name=last-order]').attr("content");

    waitForChanges();

    $(document).on('click', 'button[name=Accept]', function (e) {

        ajaxRequest("orders/accept/" + $(this).data('id'), "GET", null, function (res) {
            updateTa();
            lastOrder = res.update;
        });
    })

    $(document).on('click', 'button[name=Complete]', function (e) {

        ajaxRequest("orders/complete/" + $(this).data('id'), "GET", null, function (res) {
            updateTa();
            lastOrder = res.update;
        });
    })

    $("button[name=Create]").click(function () {
        renderModal("orders/create", submit, null);
    });
    $(document).on('click', 'button[name=AddMenu]', function () {
        var url = 'orders/MenuModal/' + $('#SelectedMenu').val();
        console.log(url)
        renderMenu(url);
        console.log($("#SelectedMenu").val())
    });

    $(document).on('click', 'button[name=deleteGroup]', function () {
        $(this).parents().closest(".card").remove();
    });

    $(document).on('click', ".itemMenu", function () {
        if ($(this).hasClass("alert-success")) {
            $(this).removeClass("alert alert-success");
        } else {
            $(this).addClass("alert alert-success");
        }
    });
    $(document).on('click', "button[name=AddProduct]", function () {
        selectorPagination = "#AvaibleList";
        renderModal("orders/addProducts", submitProducts, function () {
            loadItems('products');
        }, "#ModalAddProducts");
    });
    $(document).on('click', "button[name=AddPlate]", function () {
        selectorPagination = "#AvaibleList";
        renderModal("orders/addPlates", submitPlates, function () {
            loadItems('plates');
        }, "#ModalAddPlate");
    });

    $(document).on('click', 'button[name=ViewOrder]', function () {
        renderModal('orders/' + $(this).data('id'))
    })



    $(document).on('click', 'button[name=deleteItem]', function () {

        $(this).parent().remove()
    })
    $(document).on('click', 'button[name=Delete]', function () {
        remove($(this).data('id'))
        $(this).parent().parent().remove()

    })
    console.log('----- orders.js Ready ------')

});


function waitForChanges(){
    interval = setInterval(function () {

        ajaxRequest("orders/last", "GET", null, function (res) {

            console.log(lastOrder + " - " + res.update)
            ren_spinner(false)
            if (lastOrder != res.update) {
                console.log("ACTUALIZAR")
                lastOrder = res.update;
                updateTa();
            }

        });
    }, 3000);
}

function updateTa() {
    ajaxRequest("orders", "GET", null, function (res) {
        $('tbody tr').remove();
        console.log(res)
        res.html.forEach(element => {
            $('tbody').append(element)
        });
        ren_spinner(false);
        fadeInAll();
    });
}

function renderMenu(url) {

    ajaxRequest(url, "GET", null, function (res) {
        $("#accordion").append(res.html);

    });

}

/**
 * Limpia todos los items del serchbox
 */
function clearSearchBox() {
    $('#AvaibleList .list-group-item.Item').remove();
    $('#pagination .pagination').remove();
}

let products;
let plates;
var submit = function () {
    products = []
    plates = []


    $("#accordion").children('.card').each(function () {
        $(this).find(".itemMenu.alert.alert-success").each(function () {
            if ($(this).data('type') == "product") {
                pushProduct($(this).data('id'));

            } else {
                pushPlate($(this).data('id'))
            }
        });
    });
    $("#OrderProducts").children("li").each(function () {
        pushProduct($(this).data('id'));
    });
    $("#OrderPlates").children("li").each(function () {
        pushPlate($(this).data('id'))
    });

    var order = {
        'name': $('#name').val(),
        "products": products,
        "plates": plates
    }

    var data = JSON.stringify(order)
    ajaxRequest("./orders", "POST", data, function (response) {
        clearInterval(interval)
        $("tbody").append(response.html);
        fadeInAll();
        ren_spinner(false)
        alertify.success(response.message)
        closeModal($('#modalBox'));
        lastOrder = response.update;
        waitForChanges();
 
        
        console.log(lastOrder + " la")
    })


    console.log(order)

}
function pushPlate(id) {
    var h = findDuplicate(plates, id);

    if (h == -1) {
        var plate = {
            "id": id,
            "quantity": 1,
        }
        plates.push(plate);
    } else {
        plates[h].quantity++;
    }
}

function pushProduct(id) {
    var h = findDuplicate(products, id);

    if (h == -1) {
        var product = {
            "id": id,
            "quantity": 1,
        }
        products.push(product);
    } else {
        console.log("AAAA")
        products[h].quantity++;
    }

}
function findDuplicate(array, value) {
    let i = 0;
    let h = -1
    array.forEach(element => {

        if (element.id == value) {

            h = i
        }
        i++;
    });

    return h;
}

var submitProducts = function () {

    $("#SelectedList").children("li").each(function () {

        let a = $(this).clone().appendTo("#OrderProducts");
        a.append('<button name="deleteItem" type="button" class=" btn btn-danger btn-small float-right mr-2"> X </button>')

    });

    closeModal($("#ModalAddProducts"));
}

var submitPlates = function () {

    $("#SelectedList").children("li").each(function () {

        let a = $(this).clone().appendTo("#OrderPlates");
        a.append('<button name="deleteItem" type="button" class=" btn btn-danger btn-small float-right mr-2"> X </button>')


    });

    closeModal($("#ModalAddPlate"));
}


function remove(id) {
    ajaxRequest("orders/" + id, 'DELETE', null, function (response) {
        clearInterval(interval)
        alertify.warning(response.message);
        console.log(response)
        ren_spinner(false);
        lastOrder = response.update;
        waitForChanges();

    });
}




