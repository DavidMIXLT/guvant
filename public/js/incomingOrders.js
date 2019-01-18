
var stock;
var textBoxStock;
var finalStock;
var table;

$( document ).ready(function() {
    $(".inputStock").keyup(function(){
        console.log($(this).val())
    })
});

window.onload = function () {
    textBoxStock = document.getElementById('textBoxStock');
    stock = document.getElementById('stock');
    finalStock = parseInt(stock.innerHTML);
   


 
}


function updateStock() {

    if(Number.isInteger(parseInt(textBoxStock.value)) ){
        stock.classList.add('bg-success');
        stock.innerHTML = finalStock + parseInt(textBoxStock.value);
    }else{
        stock.innerHTML = finalStock;
        stock.classList.remove("bg-success");
    }

}