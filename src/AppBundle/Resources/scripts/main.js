
var food = [];

window.onload = function(){
    var myInput3 = document.getElementById('kcal');
    myInput3.oninput = function () {
        if (this.value.length > 4) {
            this.value = this.value.slice(0,4);
        }
    };

    getFood();

    var calculate = document.getElementById("calculate");
    calculate.onclick = function ()     {
        var ac = 0;
        var num = 0;
        var gen = 0;
        var age = document.getElementById("age").value;
        var height = document.getElementById("height").value;
        var weight = document.getElementById("weight").value;

        if (document.getElementById('men').checked) {
            gen = 1;
        }
        else if (document.getElementById('wmen').checked) {
            gen = 2;
        }

        if (document.getElementById('a1').checked) {
            ac = 1.2;
        }
        else if (document.getElementById('a2').checked) {
            ac = 1.375;
        }
        else if (document.getElementById('a3').checked) {
            ac = 1.55;
        }
        else if (document.getElementById('a4').checked) {
            ac = 1.725;
        }
        else if (document.getElementById('a5').checked) {
            ac = 1.9;
        }

        if (gen === 1) {
            num = ac * (66.47 + (13.75 * weight) + (5.0 * height) - (6.75 * age));
        }
        else {
            num = ac * (665.09 + (9.56 * weight) + (1.84 * height) - (4.67 * age));
        }
        console.log(weight);
        console.log(height);
        console.log(age);
        console.log(ac);
        console.log(num);
        document.getElementById("kcal").value = Math.round(num);
    };

    updateMenu();

};


function updateValue(par1, par2){
    var value = document.getElementById(par2).value;
    document.getElementById(par1).innerHTML = value;

    return value;
}

function updateMenu() {
    var ingredients = food;
    var mealTimes =  updateValue("meal", "mealTime");
    var daysCount =  updateValue("days", "daysCount");
    var calories = document.getElementById("kcal").value;

    $.ajax({
        url: "/getMeals",
        dataType: "json",
        data: {"days": daysCount, "mealTimes": mealTimes, "cal": calories, "blockedIngredients": ingredients},
        success: function (response) {
            $ul = $("#sort");
            $ul.empty();
            for(var i in response){
                $ul.append('<li class="menu foodEl">' +
                                '<img src="http://g3.dcdn.lt/images/pix/blynai-70357526.jpg" class="menu-img">' +
                                '<a href="#modal3"><p class="menu-name">' + response[i].name + '</p></a>' +
                                '<div class="li-setting">' +
                                    '<input type="number" class="portion" value="4">' +
                                    '<label class="portion">porc.</label>' +
                                    '<button class="action" ><a href="#modal2"><img src="images/icons/change.png" class="action"></a></button>' +
                                    '<button class="action" id="delete"><img src="images/icons/delete.png" class="action"></button>' +
                                '</div>' +
                        '</li>');
                var listEl = document.getElementsByClassName("foodEl");
                console.log(listEl);
                listEl.id = response[i].id;
            }
        }
    })
}

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
            $('.chips').on('chip.add', function(e, chip){
                food.push(chip.tag);
                updateMenu();
            });
            $('.chips').on('chip.delete', function(e, chip){
                var index = food.indexOf(chip.tag);
                food.splice(index, 1);
                updateMenu();
            });
        }
    })
}



var $j = jQuery.noConflict();

$j( document ).ready(function() {
    $('#sort').sortable();
    $('#sort1').sortable();

    $('#kcal').each(function(){
        var value = $(this).val();
        var size  = value.length;
        size = size*3.5;
        $(this).css('width',size*3);
    });

    $(function() {
        $( "#sort, #sort1" ).sortable({
            connectWith: ".connected"
        }).disableSelection();
        $( ".disabled" ).sortable("option","disabled", true).disableSelection();
    });

    $(document).on('click', '#delete', function() {
        $(this).closest('li').toggleClass('strike').fadeOut('slow', function() { $(this).remove(); });
    });



    $('.modal').modal({complete: function() { $("body").css('overflow','visible') }});
    $('#kcalclick').click(function(){
        $.fn.fullpage.setAllowScrolling(false);
        $.fn.fullpage.setKeyboardScrolling(false);
        $('#modal1').modal('open');

    });
    $('#calculate').click(function(){
        $.fn.fullpage.setAllowScrolling(true);
        $.fn.fullpage.setKeyboardScrolling(true);
    });

        $('#fullpage').fullpage({
            scrollBar:true,
            hybrid: true,
            fitToSection:false
        });
});