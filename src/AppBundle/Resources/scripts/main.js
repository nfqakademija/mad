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

    days = ['Pirma diena', 'Antra diena', 'Trečia diena', 'Ketvirta diena', 'Penkta diena', 'Šešta diena', 'Septinta diena', 'Aštunta diena', 'Devinta diena', 'Dešimta diena', 'Vienuolikta diena', 'Dvylikta diena',
            'Trylikta diena', 'Keturiolikta diena', 'Penktiolikta diena', 'Šešiolikta diena', 'Septyniolikta diena', 'Aštoniolikta diena', 'Devyniolikta diena', 'Dvidešimta diena', 'Dvidešimt pirma diena',
            'Dvidešimt antra diena', 'Dvidešimt trečia diena', 'Dvidešimt ketvirta diena', 'Dvidešimt penkta diena', 'Dvidešimt šešta diena', 'Dvidešimt septinta diena', 'Dvidešimt aštunta diena',
            'Dvidešimt devinta diena', 'Trisdešimta diena'];

    var start = 0;
    var end = start + parseInt(mealTimes);

    $.ajax({

        url: "/getMeals",
        dataType: "json",
        data: {"days": daysCount, "mealTimes": mealTimes, "cal": calories, "blockedIngredients": ingredients},
        success: function (response) {
            $menuList = $("#scroll").empty();
            for (var i = 0; i < daysCount; i++){
                var idOfUl = "sort" + (i + 1);
                $menuList.append('<ul id="' + idOfUl + '" class="connected menu sort"></ul>');

                $ul = $("#" + idOfUl);
                $ul.append('<li class="disabled day"><p class="day">' + days[i] + '</p></li>');
                for(var j = start; j < end; j++){
                    console.log("j=" + j);
                    console.log("ul=" + $ul);
                    $ul.append(
                        '<li class="menu" id="' + response[j].id + '">' +
                        '<img src="recipes_images/'+ response[j].logo + '" class="menu-img">' +
                        '<a onclick="showRecipe(this)" id="' +  response[j].id+ '"><p class="menu-name">' + response[j].name + '</p></a>' +
                        '<div class="li-setting">' +
                        '<input type="number" class="portion" value="4">' +
                        '<label class="portion">porc.</label>' +
                        '<button class="action" ><a href="#modal2"><img src="images/icons/change.png" class="action"></a></button>' +
                        '<button class="action" id="delete"><img src="images/icons/delete.png" class="action"></button>' +
                        '</div>' +
                        '</li>');
                }
                start = end;
                end += parseInt(mealTimes);
            }
            $('.sort').sortable({
                connectWith: ".connected",
                cancel: ".disabled"
            });
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




    $('#kcal').each(function(){
        var value = $(this).val();
        var size  = value.length;
        size = size*3.5;
        $(this).css('width',size*3);
    });
        $('.tooltipped').tooltip({delay: 50});


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

function showRecipe(element) {
  var id = $(element).attr("id");
  console.log("clicked");
  $.ajax({
      url: "searchMeals/" + id,
      success: function(response){
          createModal(response);
          $('#modal3').modal('open')
      }
  })
}

function createModal(response) {
    document.append('<div id="modal3" class="modal my-modal">' +
                                '<button class="modal-close btn-flat close-button">Close</button>' +
                                '<div class="modal-content">' +
                                    '<div class="row">' +
                                        '<div class="col s12">' +
                                            ' <h4>' + response.name +'</h4>' +
                                        '</div>' +
                                        '<div class="col s10 offset-s1 m6 l4">' +
                                            '<img class="responsive-img" src="' + response.logo +'">' +
                                        '</div>' +
                                        '<div class="col s6 offset-s3 m6 l8">' +
                                            '<ul style="font-size: 20px;">' +
                                                '<li><i class="material-icons info-ico">av_timer</i> Laikas: <span class="info-value">35 min</span></li>' +
                                                '<li><i class="material-icons info-ico">swap_calls</i> Kalorijos: <span class="info-value">517 kcal</span></li>' +
                                                '<li><i class="material-icons info-ico">perm_identity</i> Porcijos: <span class="info-value">4</span></li>' +
                                                '<li><i class="material-icons info-ico">list</i> Kategorija: <span class="info-value">pagrindinis</span></li>' +
                                            '</ul>' +
                                        '</div>' +
                                    '</div>' +
                                    '<div class="row">' +
                                        '<div class="col s10 offset-s1 m8 l8">' +
                                            '<span class="title-underline">Paruošimas</span>' +
                                            '<p>aaa</p>' +
                                        '</div>' +
                                    '</div>' +
                                '</div>');
}