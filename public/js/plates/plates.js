$(document).ready(function () {

    $("button[name=Create]").click(function () {
        renderModal("plates/create", submit,onLoadModal);
    });


    console.log("----Plates.js Ready----");
});


var onLoadModal = function(){
    onClickOnItemList();

}


var submit = function () {
    onClickOnItemList();
    
    var ProductList = new Array;

    $('#SelectedProducts').children().each(function(){
        ProductList.push($(this).val());
    });

    var data = $("#modalForm").serialize() + "&ProductList=" + ProductList;
    console.log(data);

    ajaxRequest("plates",'POST',data,function(response){
        alertify.success('Plato creado correctamente');
        $("tbody").append(response.html)
        closeModal($('#modalBox'));
        console.log(response.products)
    });

}


function onClickOnItemList() {
    $('.productItem').click(function () {
        console.log("click")
        if ($(this).parent().attr('id') == "ProductList") {
            $(this).appendTo("#SelectedProducts");
        } else {
            $(this).appendTo("#ProductList");
        }

    });
}

