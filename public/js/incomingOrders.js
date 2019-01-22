$(document).ready(function () {
    $(".inputStock").keyup(function () {
        var stockColumn = $(this).parent().next();

        
        if ($.isNumeric($(this).val())) {
            $(this).parent().children("div").addClass("d-none");
            $(this).removeClass("border border-danger");
            $(this).parent().next(".stock").addClass("bg-success");
            stockColumn.text(parseInt(stockColumn.attr('stock')) + parseInt($(this).val()));
        } else {
      
            if($(this).val()){
                $(this).parent().children("div").removeClass("d-none");
                $(this).addClass("border border-danger");
            }

            stockColumn.text(stockColumn.attr('stock'));
            $(this).parent().parent().children(".stock").removeClass("bg-success");
        }
    })


    $('#idRow').click(function () {
        sortTableInt(0);
    });
    $('#nameRow').click(function () {
        sortTableString(1);
    });

    $('#updateButton').click(function () {

        var hiddenInput = $("#hiddenValue");
        var areValuesInTheInputs = false;
        var stockValues = "";
        $(".bg-success").each(function (index) {

            stockValues += $(this).parent().children(":first-child").text() + ":" + $(this).text() + " ";
            areValuesInTheInputs = true;
        });

        $("#hiddenValue").val(stockValues);
        if (areValuesInTheInputs) {
            $("#updateProductStockTable").submit();
        }

    });
});
