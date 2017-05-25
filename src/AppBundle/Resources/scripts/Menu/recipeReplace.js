function replaceRecipe(id) {
    var Id = idAndDay.getId();
    var Day = idAndDay.getDay();
    var Index = idAndDay.getIndex();

    console.log(Id + " = " + Day);

    var $li = $('.table li.menu').filter(function() {
        return $(this).data('id') === Id && $(this).data('day') === Day && $(this).index() === Index ;
    });

    $.ajax({
        url: "/getMeal",
        data: {"id": id},
        success: function (response) {
            $li.empty();
            $li.data({"id": response[0].id});
            $li.html(
                '<img src="recipes_images/'+ response[0].logo+ '" class="menu-img">' +
                '<a class="recipeShow"><p class="menu-name">' + response[0].name + '</p></a>' +
                '<div class="li-setting">' +
                '<input type="number" class="portion" value="4">' +
                '<label class="portion">porc.</label>' +
                '<a href="#modal2"><button class="action changeRecipe"><img src="images/icons/change.png" class="action"></button></a>' +
                '<button class="action deleteLi" ><img src="images/icons/delete.png" class="action"></button>' +
                '</div>');
        }
    });
    $("#modal2").modal("close");
}

