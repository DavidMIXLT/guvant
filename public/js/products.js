var lastRowClicked;
$(document).ready(function () {

  $("#MassiveDeleteButton").click(function () {
    massiveElimination();
  });

  $("button[name=Delete]").click(function () {

    delete_product($(this).parent().parent().parent());

  });

  $("#SelectAll").click(function () {
    selectAll();
  });

  $("button[name=Edit]").click(function () {

    editProduct($(this).parent().parent().parent().find(".ProductID").text());
    lastRowClicked = $(this).parent().parent().parent();
  });




  loadTableSortEvents();
  console.log("----- Products.js Loaded -----");
});


function selectAll() {
  $("input[type=checkbox]").each(function () {
    $(this).prop('checked', true);
  });
}


/**
  * Carga los eventos para ordenar la tabla al pulsar en las cabecera
  */
function loadTableSortEvents() {
  document.getElementById('idRow').addEventListener('click', function (event) {
    sortTableInt(1);
  });
  document.getElementById('nameRow').addEventListener('click', function (event) {
    sortTableString(2);
  });
  document.getElementById('descriptionRow').addEventListener('click', function (event) {
    sortTableString(3);
  });
  document.getElementById('stockRow').addEventListener('click', function (event) {
    sortTableInt(4);
  });
  document.getElementById('dateRow').addEventListener('click', function (event) {
    sortTableDate(5);
  });

}



/**
  * Elimina las columnas que se le pasan de una tabla
  * 
  * @param  array of <TR>
  * 
  */
function ren_RemoveRow(ren_rows) {
  $(ren_rows).each(function () {
    $(this).remove();
  });
}

/**
  * Obtiene todos los IDS de los checkbox selecionados en productos.index
  *
  * @return Response AJAX
  */


function massiveElimination() {

  var ListOfID = new Array();
  var rows = $("input[type=checkbox][name=checkBoxActionDelete]:checked").parents("tr");

  $("input[type=checkbox][name=checkBoxActionDelete]:checked").each(function () {
    ListOfID.push($(this).val())
  });

  ren_spinner(true);

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $.ajax(
    {
      url: "products/-1",
      type: 'delete', // replaced from put
      dataType: "JSON",
      data: {
        "ListOfID": ListOfID // method and token not needed in data
      },
      success: function (response) {
        console.log(response); // see the reponse sent
        $(rows).fadeOut("fast", function () {
          ren_RemoveRow(rows);
        });

        ren_spinner(false);
      },
      error: function (xhr) {
        console.log(xhr.responseText); // this line will save you tons of hours while debugging
        // do something here because of error

        ren_spinner(false);
      }
    });
}

/**
  * Renderiza el spinner de loading en la tabla de productos
  * 
  * @param Boolean $ren 
  * 
  */
function ren_spinner($ren) {
  if ($ren) {
    $(".spinner-border").removeClass("invisible");
  } else {
    $(".spinner-border").addClass("invisible");
  }
}




/**
  * Elimina el producto cuando el usuario pulsa el boton de Eliminar
  *  @param int ProductID
  */
function delete_product(row) {
  var id = row.find(".ProductID").text();
  ren_spinner(true);
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $.ajax(
    {
      url: "products/" + id,
      type: 'delete', // replaced from put
      dataType: "JSON",
      data: {
      },
      success: function (response) {
        console.log(response); // see the reponse sent  
        ren_RemoveRow(row);
        ren_spinner(false);
      },
      error: function (xhr) {
        console.log(xhr.responseText); // this line will save you tons of hours while debugging
        // do something here because of error

        ren_spinner(false);
      }
    });

}

/**
  * Muestra el formulario de edicion del producto
  *  @param int ProductID
  */
function editProduct(id) {
  ren_spinner(true);
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $.ajax(
    {
      url: "products/" + id + "/edit",
      type: 'GET', // replaced from put
      dataType: "JSON",
      data: {
      },
      success: function (response) {
        $('body').append(response.html)
        $('#editModal').modal('show');

        /**
          * Carga los eventos del Modal tanto para cerrarlo como para enviarlo
          */
        $("button[name=closeModal]").click(function () {
          closeModal($('#editModal'));
        });
        $("button[name=submitEdit]").click(function () {
          postEdit();
      
          
        });
        ren_spinner(false);
      },
      error: function (xhr) {
        console.log("AJAX Error");
        console.log(xhr.responseText); // this line will save you tons of hours while debugging
        // do something here because of error

        ren_spinner(false);
      }
    });
}

/**
  * Cierra y elimina el Modal creado
  *  @param Modal
  */



function postEdit() {
  ren_spinner(true);
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $.ajax(
    {
      url: "products/" + $("input[name=Id]").val(),
      type: 'PUT',
      dataType: "JSON",
      data: $("#editProduct").serialize(),
      success: function (response) {

        updateRow(lastRowClicked);
        closeModal($('#editModal'));
        console.log("success")
        ren_spinner(false);
      },
      error: function (xhr) {
        closeModal($('#editModal'));
        console.log("AJAX Error");
        console.log(xhr.responseText); 
        ren_spinner(false);
      }
    });
}

function updateRow(row){

  row.find(".ProductName").text($('input[name="Name"]').val());
  row.find(".ProductStock").text($('input[name="Stock"]').val());

  row.find(".ProductDescription").text($('textarea[name="Description"]').val());

}

function closeModal(Modal) {
  Modal.modal('hide');
  Modal.remove();
}

