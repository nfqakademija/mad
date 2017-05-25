function modalsTweaks() {
    $('.modal').modal({complete: function() { $("body").css('overflow','visible') }});

    $('#kcalclick').click(function() {
        $.fn.fullpage.setAllowScrolling(false);
        $.fn.fullpage.setKeyboardScrolling(false);
        $('#modal1').modal('open');
    });
}

function showRecipe(id) {
    $.ajax({
        url: "/getMeal",
        data: {"id": id},
        dataType: "json",
        async: "false",
        success: function(response){
            createModal(response);
            $modal = $("#modal3");
            $modal.modal({
                complete: function () {
                    $modal.remove();
                }
            });
            $modal.modal('open');
        }
    });
}

