function createModal(response) {
    response.forEach(function(element) {
        $("#fullpage").append('<div id="modal3" class="modal my-modal">' +
            '<button class="modal-close btn-flat close-button"><i class="material-icons red">close</i></button>' +
            '<div class="modal-content">' +
            '<div class="row">' +
            '<div class="col s12">' +
            ' <h4 class="title-recipe">' + element.name + '</h4>' +
            '</div>' +
            '<div class="col m12">' +
            '<img class="recipeImage" src="recipes_images/' + element.logo + '">' +
            '</div>' +
            '<div class="col m12">' +
            '<ul>' +
            '<li class="about"><i class="material-icons info-ico">whatshot</i> Kalorijos: <span class="info-value">'+ Math.round(parseInt(element.calories)) +' kcal</span></li>' +
            '<li class="about"><i class="material-icons info-ico">perm_identity</i> Porcijos: <span class="info-value">1</span></li>' +
            '</ul>' +
            '</div>' +
            '</div>' +
            '<div class="row">' +
            '<div class="col m12">' +
            '<span class="title-underline">Paruošimas</span>' +
            '<p>'+element.howToMake+'</p>' +
            '</div>' +
            '</div>' +
            '</div>'
        );
    });
}