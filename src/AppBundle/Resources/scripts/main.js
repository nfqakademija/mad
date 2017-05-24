var blockedIngredients = new SetBlockedIngredients();
var selector = new Selector();

$(document).ready( function () {
    Calculator.bind(); // Menu/calculator.js

    sliceCaloriesInput(); // tweaks.js
    sliceCaloriesInputSize(); // tweaks.js
    fullPageSettings(); // tweaks.js
    getIngredientsForBlock();

    modalsTweaks(); // Modals/modalsActions.js

    updateMenu(); // Menu/updates.js

    showMealsForSearch(); // ingredientsSearch.js
    showMealsForSearchOnKey(); // ingredientsSearch.js
    deleteLi(); // tweaks.js

    showDatas();
});


function showDatas() {
    $li =  $(".table li.menu");

}


var data = [];
function getDataOfRecipes() {
    $li.each(function (key, elem) { data.push({'day': elem.data("day"), 'id': elem.data("id"), 'val': 4})} )
}




















