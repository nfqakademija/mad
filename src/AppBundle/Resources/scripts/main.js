var blockedIngredients = new SetBlockedIngredients();
var selector = new Selector();
var idAndDay = new IdAndDay();
var menuData = new DataOfMenu();

$(document).ready( function () {

    Calculator.bind(); // Menu/calculator.js

    sliceCaloriesInput(); // tweaks.js
    sliceCaloriesInputSize(); // tweaks.js
    fullPageSettings(); // tweaks.js
    getIngredientsForBlock();

    deleteLi();

    modalsTweaks(); // Modals/modalsActions.js

    updateMenu(); // Menu/updates.js


    setIdGetter();
    showMealsForSearch(); // ingredientsSearch.js
    showMealsForSearchOnKey(); // ingredientsSearch.js


    putRecipeId();
    getList();
});




function DataOfMenu() {
    this.data = [];
    this.setData = function (arg) {
        this.data.push(arg);
    };
    this.getData = function () {
        return this.data;
    };
}


function getDataOfRecipes() {
    $(".table li.menu").each(function (key, elem) {
        menuData.setData({
            "day": $(elem).data("day"),
            "id": $(elem).data("id"),
            "val": $(elem).find(".portion").val(),
            "index": $(elem).index()
        }
        )
    });
}

function getList() {
    $(document).on('click', '#getList', function(e){
        e.preventDefault();
        getDataOfRecipes();
    });
}

function setIdGetter() {
    $(document).on('click', '.changeRecipe', function(e){
        e.preventDefault();
        var id = $(this).closest('li').data("id");
        var day = $(this).closest('li').data("day");

        idAndDay.setId(id);
        idAndDay.setDay(day);
    });
}



function putRecipeId() {
    $(document).on('click', '.recipeShow', function(e){
        e.preventDefault();
        var id =  $(this).closest('li').data('id');
        showRecipe(id);
    });
}

















