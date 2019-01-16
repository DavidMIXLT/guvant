
var deleteButton;
var checkBoxListInput;
var massiveAction;
var table;
window.onload = function () {

  deleteButton = document.getElementById('deleteButton');
  checkBoxListInput = document.getElementById('checkBoxList');
  massiveAction = document.getElementById('massiveAction');
  table = document.getElementById("productTable");
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

function sortTableDate(n) {
  var n, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;

  switching = true;

  dir = "asc";

  while (switching) {

    switching = false;
    rows = table.rows;

    for (i = 1; i < (rows.length - 1); i++) {

      shouldSwitch = false;
      x = rows[i].getElementsByTagName("TD")[n];
      y = rows[i + 1].getElementsByTagName("TD")[n];

      xD = new Date(x.getElementsByTagName('a')[0].innerHTML);
      xY = new Date(y.getElementsByTagName('a')[0].innerHTML)

      if (dir == "asc") {
        if (xD > xY) {
          shouldSwitch = true;
          break;
        }
      } else if (dir == "desc") {
        if (xD < xY) {
          shouldSwitch = true;
          break;
        }
      }
    }
    if (shouldSwitch) {
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      switchcount++;
    } else {
      if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
      }
    }
  }
}


function sortTableString(n) {
  var rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;

  switching = true;

  dir = "asc";

  while (switching) {

    switching = false;
    rows = table.rows;

    for (i = 1; i < (rows.length - 1); i++) {

      shouldSwitch = false;

      x = rows[i].getElementsByTagName("TD")[n].getElementsByTagName('a')[0];
      y = rows[i + 1].getElementsByTagName("TD")[n].getElementsByTagName('a')[0];

      if (dir == "asc") {
        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          shouldSwitch = true;
          break;
        }
      } else if (dir == "desc") {
        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
          shouldSwitch = true;
          break;
        }
      }
    }
    if (shouldSwitch) {
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      switchcount++;
    } else {
      if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
      }
    }
  }
}



function sortTableInt(n) {
  var rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;

  switching = true;

  dir = "asc";

  while (switching) {

    switching = false;
    rows = table.rows;

    for (i = 1; i < (rows.length - 1); i++) {

      shouldSwitch = false;
      x = rows[i].getElementsByTagName("TD")[n].getElementsByTagName('a')[0];
      y = rows[i + 1].getElementsByTagName("TD")[n].getElementsByTagName('a')[0];
      console.log
      if (dir == "asc") {
        if (Number(x.innerHTML) > Number(y.innerHTML)) {
          shouldSwitch = true;
          break;
        }
      } else if (dir == "desc") {
        if (Number(x.innerHTML) < Number(y.innerHTML)) {
          shouldSwitch = true;
          break;
        }
      }
    }
    if (shouldSwitch) {
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      switchcount++;
    } else {
      if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
      }
    }
  }
}
