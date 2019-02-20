var selectedCategories = [];
var filter_url;

$(document).ready(function () {
  

    $('#dropDown_Items').on('click', function (e) {
        e.stopPropagation();
    });

    $("input[name=categoryCheckBox").change(function (e) {

        filterActive = isFilterActive();
        var category = $(this).parent().find("label").text();
        updateCategoryList(category);      
    });

    $('button[name=applyFilter]').click(function(e){
        $('#dropDown_Items').hide();
        postCategoryList(filter_url, getDataCategories());
    });
    $('input[name=categoryCheckBox]').prop('checked',false);
    console.log("----Filter.js Ready----");
});

function getDataCategories() {

    var data = '{"selectedCategories" : ' + JSON.stringify(selectedCategories) + "}";
    console.log(data)
    return data;
}


function postCategoryList(url, data) {
    ajaxRequest(url, 'POST', data, function (res) {
        
        console.log(res.paginationHTML);
        emptyTable();
        $('tbody').append(res.html);
        updatePaginationLinks(res.paginationHTML)
        fadeInAll();
        ren_spinner(false);
    });
}

function isFilterActive() {
    if (selectedCategories.length > 0) {
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

