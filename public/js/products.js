
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

  loadTableSortEvents();
  console.log("----- Products.js Loaded -----");
};

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
