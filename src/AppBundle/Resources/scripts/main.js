var blockedIngredients = new SetBlockedIngredients();
var selector = new Selector();

$(document).ready( function () {
    sliceCaloriesInput(); // tweaks.js
    sliceCaloriesInputSize(); // tweaks.js
    fullPageSettings(); // tweaks.js
    getIngredientsForBlock();

    modalsTweaks(); // Modals/modalsActions.js

    updateMenu(); // Menu/updates.js

    showMealsForSearch(); // ingredientsSearch.js
    showMealsForSearchOnKey(); // ingredientsSearch.js
    deleteLi(); // tweaks.js

});





















