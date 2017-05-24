function replaceRecipe(Id, Day) {
    $li = $("li[id = Id][day = Day]");

    $.ajax({
        url: "/getMeal",
        data: {"id": id},
        success: function (response) {
            $li.empty();
            $li.data({"id": response[0].id});
            $li.html(
                '<img src="recipes_images/'+ response[0].logo+ '" class="menu-img">' +
                '<a onclick="showRecipe(this)" id="' +  response[0].id+ '"><p class="menu-name">' + response[0].name + '</p></a>' +
                '<div class="li-setting">' +
                '<input type="number" class="portion" value="4">' +
                '<label class="portion">porc.</label>' +
                '<a href="#modal2"><button class="action" id="' + response[0].id + "/" + split[1] + '" onclick="getRecipeId(this.id)"><img src="images/icons/change.png" class="action"></button></a>' +
                '<button class="action" id="delete"><img src="images/icons/delete.png" class="action"></button>' +
                '</div>');
        }
    });
    $("#modal2").modal("close");
}

