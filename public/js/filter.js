var selectedCategories = [];
var filter_url = "./filter";
var booleanASCDESC = false;
var filterColumn = "id";
var filterOrder = "ASC";

$(document).ready(function () {


    $('#dropDown_Items').on('click', function (e) {
        e.stopPropagation();
    });

    $("input[name=categoryCheckBox").change(function (e) {

        filterActive = isFilterActive();
        var category = $(this).parent().find("label").text();
        updateCategoryList(category);
    });

    $('button[name=applyFilter]').click(function (e) {
        $('button.dropdown-toggle#categories').dropdown('toggle');
        postFilter(getDataCategories());
    });

    $('th').click(function () {
        booleanASCDESC = !booleanASCDESC;
        filterColumn = $(this).prop('id');
        if (booleanASCDESC) {
            console.log('asc')
            filterOrder = 'ASC';
            postFilter(getDataCategories());
        } else {
            console.log('desc')
            filterOrder = 'DESC';
            postFilter(getDataCategories());
        }

    });
    $('input[name=categoryCheckBox]').prop('checked', false);
    console.log("----Filter.js Ready----");
});

function postFilter(data) {
    console.log(filter_url)
    ajaxRequest(filter_url, 'POST', data, function (res) {
      
        renderResult(res);
    });
}


function getDataCategories() {
    var data
    data = '{"selectedCategories" : ' + JSON.stringify(selectedCategories) + ',"mode" : "' + filterColumn + '","order" : "' + filterOrder + '"  }';
    console.log(data)
    return data;
}

function renderResult(res) {

    emptyTable();
    $('tbody').append(res.html);
    updatePaginationLinks(res.paginationHTML)
    fadeInAll();
    ren_spinner(false);
}

function postCategoryList(url, data) {
    ajaxRequest(url, 'POST', data, function (res) {

        renderResult(res);
    });
}

function isFilterActive() {
    if (selectedCategories.length > 0 || filterColumn != "") {
        return true;
    } else {
        return false;
    }

}

function clearCategories() {
    $("tr").removeClass('d-none');
}
function updateCategoryList(newCategory) {
    clearCategories();

    var exists = false;
    for (let i = 0; i < selectedCategories.length; i++) {
        if (selectedCategories[i] === newCategory) {
            selectedCategories.splice(i, 1);

            return;
        }
    }
    if (!exists) {
        selectedCategories.push(newCategory);
    };

}

