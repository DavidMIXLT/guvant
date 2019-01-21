$(document).ready(function () {
    $(".inputStock").keyup(function () {
        var stockColumn = $(this).parent().next();
        if ($.isNumeric($(this).val())) {
            $(this).parent().next(".stock").addClass("bg-success");
            stockColumn.text(parseInt(stockColumn.attr('stock')) + parseInt($(this).val()));
        } else {
            $(this).val("");
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

        var stockValues = "";
        $(".bg-success").each(function (index) {

            stockValues += $(this).parent().children(":first-child").text() + ":" + $(this).text() + " ";

        });

        $("#hiddenValue").val(stockValues);
        $("#updateProductStockTable").submit();
    });
});
