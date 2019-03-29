$(document).ready(function () {

    /**
     * Crud -- Add menu
     */
    $("button[name=Create]").click(function(){
        renderModal("orders/create", submit, null);
    });

    $(document).on('click','button[name=AddMenu]',function(){
        var url = 'orders/MenuModal/' + $('#SelectedMenu').val();
        console.log(url)
        renderMenu(url);
        console.log($("#SelectedMenu").val())
    });

    console.log('----- orders.js Ready ------')
});


function renderMenu(url){
    ajaxRequest(url,"GET",null,function(res){
        $("#accordion").prepend(res.html);
    });
}


var submit = function(){

}