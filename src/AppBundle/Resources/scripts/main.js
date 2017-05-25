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

            $.ajax({
                url: "/isUserLoggedIn",
                success: function (response) {
                    if(response == 1) {
                        $.ajax({
                            url: "/addMealsToUser",
                            dataType: "json",
                            data: {"doc": menuData.getData()},
                            success: function (response) {
                                console.log('Issaugojo meniu');
                            }
                        });
                    } else {
                        console.log('neprisijunges');
                    }
                }
            });
            $("#basket").empty();
            for(i in response){
                if(response[i].count == 0) {
                    $("#basket").append(
                        '<li>' + response[i].name + " " + response[i].amount + " "  + response[i].type + '</li>'
                    )
                } else {
                    $("#basket").append(
                        '<li>' + response[i].name + " " + response[i].count + " "  + response[i].type + '</li>'
                    )
                }

            }
            printDiv('modal4');
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

function printDiv(printpage) {
    var divToPrint=document.getElementById(printpage);

    var newWin=window.open('','Print-Window');

    newWin.document.open();

    newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');

    newWin.document.close();

    setTimeout(function(){newWin.close();},10);
}

















