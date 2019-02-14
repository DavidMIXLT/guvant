var selectedCategories = [];

$(document).ready(function () {
    
    $('.dropdown-menu').on('click', function (e) {
        e.stopPropagation();
    });

    $("input[name=categoryCheckBox").change(function (e) {

        
        var category = $(this).parent().find("label").text();
        updateCategoryList(category);
      
        filter_by_Category(selectedCategories);


    });


    console.log("----Filter.js Ready----");
});

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


function filter_by_Category(categories) {
    console.log(categories.length)
    if (categories.length > 0) {
        $("#productTable").children('tbody').children('tr').each(function () {
            var l_categories = $(this).attr('data-categories').split(',');
            var hasCategory = false;
            var n = 0;
            for (let i = 0; i < categories.length; i++) {
                for (let h = 0; h < l_categories.length; h++) {
                    if (l_categories[h] == categories[i]) {
                        n++;
                    }

                }
            }
            if (n != (categories.length)) {
                $(this).addClass('d-none');
            }
        });
    }

}