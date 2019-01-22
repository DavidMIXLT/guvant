

$(document).ready(function () {
    console.log("ready!");
    $("button").click(function () {
        console.log("Enviado")
        $.get("orders/1", function (data, status) {
            alert("Data: " + data + "\nStatus: " + status);
        });
    });
});