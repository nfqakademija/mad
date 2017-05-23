var blockedIngredients = new SetBlockedIngredients();
var selector = new Selector();

$(document).ready( function () {
    sliceCaloriesInput(); // tweaks.js
    sliceCaloriesInputSize(); // tweaks.js
    fullPageSettings(); // tweaks.js

    modalsTweaks(); // Modals/modalsActions.js

    updateMenu(); // Menu/updates.js
    
    function getData() {
        var data = [];
        $(".table li.menu").each(function (key, elem) { data.push($(elem).data('id'))} );
        console.log("completed");
        for(var i in data){
            console.log(data[i]);
        }
    }
    getData();
});



















