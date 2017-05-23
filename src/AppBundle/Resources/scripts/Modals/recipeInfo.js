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
            '<img class="" src="recipes_images/' + element.logo + '">' +
            '<button id="' + response.id + '" onclick="schangeRecipe(this.id)">Pakeisti</button>' +
            '</div>' +
            '<div class="col m12">' +
            '<ul>' +
            '<li><i class="material-icons info-ico">av_timer</i> Gaminimo laikas: <span class="info-value">'+element.time+'</span></li>' +
            '<li><i class="material-icons info-ico">whatshot</i> Kalorijos: <span class="info-value">'+element.calories+' kcal</span></li>' +
            '<li><i class="material-icons info-ico">perm_identity</i> Porcijos: <span class="info-value">4</span></li>' +
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