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


    putRecipeId(); //
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
    this.clearData = function () {
        this.data = [];
    }
}

function getDataOfRecipes() {
    $(".table li.menu").each(function (key, elem) {
        menuData.setData({
                "id": $(elem).data("id"),
                "multiplier": $(elem).find(".portion").val(),
                "day": $(elem).data("day"),
                "order": $(elem).index()
        }
        )
    });
}

function getList() {
    $(document).on('click', '#getList', function(e){
        e.preventDefault();
        menuData.clearData();
        getDataOfRecipes();
        getBasket();
    });
}

function getBasket() {
    $.ajax({
        url: "/getMealIngredients",
        dataType: "json",
        data: {"doc": menuData.getData()},
        success:function (response) {
            $("#basket").empty();
            for(i in response){
            $("#basket").append(
                '<li>' + response[i].name + " " + response[i].amount + " "  + response[i].type + '</li>'
            )
            }
            printDiv("modal4");
        }
    })
}

function setIdGetter() {
    $(document).on('click', '.changeRecipe', function(e){
        e.preventDefault();
        var id = $(this).closest('li').data("id");
        var day = $(this).closest('li').data("day");
        var index =  $(this).closest('li').index();

        idAndDay.setId(id);
        idAndDay.setDay(day);
        idAndDay.setIndex(index);
    });
}

function putRecipeId() {
    $(document).on('click', '.recipeShow', function(e){
        e.preventDefault();
        var id =  $(this).closest('li').data('id');
        showRecipe(id);
    });
}

function printDiv(divName) {
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;

    document.body.innerHTML = printContents;

    window.print();

    document.body.innerHTML = originalContents;
}

















