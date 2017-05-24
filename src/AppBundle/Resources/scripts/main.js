var blockedIngredients = new SetBlockedIngredients();
var selector = new Selector();
var idAndDay = new IdAndDay();

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



var data = [];

function showData() {
    for(i in data){
        console.log(data[i].day);
        console.log(data[i].id);
        console.log(data[i].val);
    }
}

function getDataOfRecipes() {
    $m =  $(".table li.menu");
    console.log($m);
    $m.each(function (key, elem) {
        data.push({
            "day": $(elem).data("day"),
            "id": $(elem).data("id"),
            "val": $(elem).find(".portion").val()
        }
        )
    });
}

function getList() {
    $(document).on('click', '#getList', function(e){
        e.preventDefault();
        console.log("gavau");
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


function deleteLi() {
    $(document).on('click', '.deleteLi', function(e){
        e.preventDefault();
        $(this).closest('li').remove();
    });
}

function putRecipeId() {
    $(document).on('click', '.recipeShow', function(e){
        e.preventDefault();
        var id =  $(this).closest('li').data('id');
        showRecipe(id);
    });
}

















