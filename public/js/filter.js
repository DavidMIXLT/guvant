var selectedCategories = [];

$(document).ready(function () {

    $(".dropCat").click(function (e) {

        //  clearCategories();
        if ($(this).find("input[type=checkbox]").is(':checked')) {
            console.log($(this).find("span").text() + " checked");
        } else {
            console.log($(this).find("span").text() + " unchecked");
        }
        //   updateCategoryList($(this).find("span").text());
        //  filter_by_Category(selectedCategories);
        e.stopPropagation();
    });


    console.log("----Filter.js Ready----");
});

function clearCategories() {
    $("#productTable").children('tbody').children('tr').each(function () {

        $(this).removeClass('d-none');

    });

}
function updateCategoryList(newCategory) {

    var exists = false;
    for (let i = 0; i < selectedCategories.length; i++) {
        console.log(selectedCategories[i])
        if (selectedCategories[i] == newCategory) {
            exists = true;
            return;
        }
    }
    if (!exists) {
        selectedCategories.push(newCategory);
    };
}


function filter_by_Category(categories) {

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
        if (n == (categories.length)) {
            $(this).addClass('d-none');
        }
    });


}