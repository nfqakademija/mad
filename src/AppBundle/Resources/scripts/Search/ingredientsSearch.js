
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