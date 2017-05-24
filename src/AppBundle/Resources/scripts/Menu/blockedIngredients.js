function SetBlockedIngredients(){
    this.ingredients = [];
    this.putIngredient = function (ingredient) {
        this.ingredients.push(ingredient);
    };
    this.pullIngredient = function (ingredient) {
        var index = this.ingredients.indexOf(ingredient);
        this.ingredients.splice(index, 1);
    };
    this.getIngredients = function () {
        return this.ingredients;
    }
}

function getIngredientsForBlock() {
    $.ajax({
        url: "/getIngredients",
        dataType: "json",
        success: function (response) {
            var foodArray = response;
            var dataFood = {};
            for (var i = 0; i < foodArray.length; i++) {
                dataFood[foodArray[i].name] = null;
            }
            chipsActions(dataFood);
        }
    })
}

function chipsActions(dataFood) {
    console.log("initialized");

    $calssificator = $('.chips');

    $calssificator.material_chip();
    $('.chips-autocomplete').material_chip({
        placeholder: "Ieškokite produkto",
        secondaryPlaceholder: "Ieškokite produkto",
        autocompleteOptions: {
            data: dataFood,
            limit: 5,
            minLength: 1
        }
    });

    $calssificator.on('chip.add', function(e, chip){
        blockedIngredients.putIngredient(chip.tag);
        console.log("added");
        var ar = blockedIngredients.getIngredients();
        for(i in ar){
            console.log(ar[i]);
            console.log("mam");
        }
        updateMenu();
    });
    $calssificator.on('chip.delete', function(e, chip){
        blockedIngredients.pullIngredient(chip.tag);
        updateMenu();
    });
}