var rowClicked;

$(document).ready(function () {

    $("button[name=Create]").click(function () {
        renderModal("plates/create", submitCreate, onLoadModal);
    });

    $("#MassiveDeleteButton").click(function () {
        massiveElimination("plates/-1");
    });
    loadEvents();
    console.log("----Plates.js Ready----");
});


function loadEvents() {

    $("button[name=Show]").click(function () {
        renderModal("plates/" + $(this).val());
    });
    $("button[name=Edit]").click(function () {
        var submitEdit = getSubmit("plates/" + $(this).val(), "PUT")
        rowClicked = $(this).parent().parent();
        renderModal("plates/" + $(this).val() + "/edit", submitEdit, onLoadModal);
    });
    $("button[name=Delete]").click(function () {
        remove($(this).val(), $(this).closest('tr'));
    });
}

function remove(id, RowClicked) {

    ajaxRequest("plates/" + id, 'DELETE', null, function (response) {
        console.log(response);
        alertify.warning(response.message);
        ren_RemoveRow(RowClicked);
        ren_spinner(false);
    });
};

var onLoadModal = function () {
    $('.productItem').click(function () {
        console.log("click")
        if ($(this).parent().attr('id') == "ProductList") {
            $(this).appendTo("#SelectedProducts");
        } else {
            $(this).appendTo("#ProductList");
        }
    });
}


var submitCreate = getSubmit("plates", "POST");


function getSubmit(url, method) {
    return function () {
        var ProductList = new Array;
        $('#SelectedProducts').children().each(function () {
            ProductList.push($(this).val());
        });

        var data = $("#modalForm").serialize() + "&ProductList=" + ProductList;
        console.log(data);

        ajaxRequest(url, method, data, function (response) {
            alertify.success(response.message);
            console.log(response.html)
            closeModal($('#modalBox'));
            ren_spinner(false);       
            if (method == "PUT") {
                updateRow(rowClicked, response.html);
            } else {
                $("tbody").append(response.html)
            }
        });

    }
}

/**
  * Actualiza las columnas con los nuevos datos
  *  @param OldRow columna
  *  @param newRow columna
  */
function updateRow(OldRow, newRow) {
    $(newRow).insertBefore(OldRow);
    OldRow.remove();
    loadEvents();
}




