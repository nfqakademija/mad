function getFood() {
    $.ajax({
        url: "/getIngredients",
        dataType: "json",
        success: function (response) {
            var foodArray = response;
            var dataFood = {};
            for (var i = 0; i < foodArray.length; i++) {
                dataFood[foodArray[i].name] = null;
            }
            $('.chips').material_chip();
            $('.chips-autocomplete').material_chip({
                placeholder: "Ieškokite produkto",
                secondaryPlaceholder: "Ieškokite produkto",
                autocompleteOptions: {
                    data: dataFood,
                    limit: 5,
                    minLength: 1
                }
            });
        }
    })
}

function chipsActions() {
    $('.chips').on('chip.add', function(e, chip){
        blockedIgredients.putIngredient(chip.tag);
        updateMenu();
    });
    $('.chips').on('chip.delete', function(e, chip){
        blockedIgredients.pullIngredient(chip.tag);
        updateMenu();
    });
}

function showMealsForSearch() {
    var word = "Cp5568C";
    $.ajax({
        url: "/searchMeals/" + word,
        dataType: "json",
        async: "false",
        success: function (response) {
            console.log("fetched");
            $(".search-result").empty();
            if(!$.trim(response)){
                $(".search-result").append('<p>Atsiprašome, tokio recepto neradome</p>')
            }
            for(var i in response){
                $(".search-result").append('<div class="col s12 m12">'+
                    '<div class="recipe-field">' +
                    '<div class="field-image">' +
                    '<img src="recipes_images/' + response[i].logo + '" class="field-image">' +
                    '</div>' +
                    '<div class="field-content">' +
                    '<h2 class="field-content">' +response[i].name +'</h2>' +
                    '<p class="about-content">Labai skanus receptas, visiems reokmenduoju</p>' +
                    '</div>' +
                    '<div class="field-action">' +
                    '<a class="btn-floating btn-medium waves-effect waves-light teal" id="' + response[i].id +'" onclick="replaceRecipe(this.id)"><i class="material-icons">add</i></a>'+
                    '</div>'+
                    '</div>' +
                    '</div>')
            }
        }
    });
}

function showMealsForSearchOnKey() {
    $('#search-meal').keyup(function() {
        var word =  $(this).val();
        if(word === ''){
            word = "Cp5568C";
            console.log(word);
        }
        $.ajax({
            url: "/searchMeals/" + word,
            dataType: "json",
            async: "false",
            success: function (response) {
                console.log("fetched");
                $(".search-result").empty();
                if(!$.trim(response)){
                    $(".search-result").append('<p>Atsiprašome, tokio recepto neradome</p>')
                }
                for(var i in response){
                    $(".search-result").append('<div class="col s12 m12">'+
                        '<div class="recipe-field">' +
                        '<div class="field-image">' +
                        '<img src="recipes_images/' + response[i].logo + '" class="field-image">' +
                        '</div>' +
                        '<div class="field-content">' +
                        '<h2 class="field-content">' +response[i].name +'</h2>' +
                        '<p class="about-content">Labai skanus receptas, visiems reokmenduoju</p>' +
                        '</div>' +
                        '<div class="field-action">' +
                        '<a class="btn-floating btn-medium waves-effect waves-light teal" id="' + response[i].id +'" onclick="replaceRecipe(this.id)"><i class="material-icons">add</i></a>'+
                        '</div>'+
                        '</div>' +
                        '</div>')
                }
            }
        })
    });
}