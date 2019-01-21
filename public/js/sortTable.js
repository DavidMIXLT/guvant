var table;

$( document ).ready(function() {

    table = document.getElementById("productTable");
});

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
  