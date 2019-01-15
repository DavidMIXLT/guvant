
var deleteButton;
var checkBoxListInput;
var massiveAction;
window.onload = function () {

    deleteButton = document.getElementById('deleteButton');
    checkBoxListInput = document.getElementById('checkBoxList');
    massiveAction = document.getElementById('massiveAction');
    deleteButton.addEventListener('click', function (event) {
        massiveElimination();
        document.getElementById("massiveAction").submit();
    });
    console.log("----- Products.js Loaded -----");
};



function massiveElimination() {
    var checkBoxes = document.getElementsByName('checkBoxAction');
    checkBoxListInput.value = "";
    for (let index = 0; index < checkBoxes.length; index++) {
        if (checkBoxes[index].checked == true) {
            console.log(checkBoxes[index].value + " ");
            checkBoxListInput.value += checkBoxes[index].value + " ";
        }


    }


}