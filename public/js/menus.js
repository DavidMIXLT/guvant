$(document).ready(function () {
    alertify.set('notifier', 'position', 'top-right');


    $("button[name=Create]").click(function () {
        renderModal("menus/create");
    });

    console.log("----- Menus.js Loaded -----");


})


