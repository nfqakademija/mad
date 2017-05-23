var food = [];

window.onload = function(){
    var myInput3 = document.getElementById('kcal');
    myInput3.oninput = function () {
        if (this.value.length > 4) {
            this.value = this.value.slice(0,4);
        }
    };

    getFood();
    showMealsForSearch();

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
                        '<img src="recipes_images/'+ response[j].logo+ '" class="menu-img">' +
                        '<a onclick="showRecipe(this)" id="' +  response[j].id+ '"><p class="menu-name">' + response[j].name + '</p></a>' +
                        '<div class="li-setting">' +
                        '<input type="number" class="portion" value="4">' +
                        '<label class="portion">porc.</label>' +
                        '<button class="action" id="' + response[i].id + "/" + idOfUl +'" onclick="getRecipeId(this.id)"><img src="images/icons/change.png" class="action"></button>' +
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


var selector;

function getRecipeId(id) {
   selector = id;
}

function replaceRecipe(id) {
    var split = selector.split("/");
    var liId = split[0];
    var ulId = split[1];

    var select = "ul#" + ulId + " li#" +liId;
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
                    $(".search-result").append('<div class="col s12 m6">'+
                        '<div class="card small">' +
                        '<div class="card-image">' +
                        '<img src="recipes_images/' + response[i].logo +'">' +
                        '</div>' +
                        '<div class="card-content">' +
                        '<p>' +response[i].name +'</p>' +
                        '</div>' +
                        '<div class="card-action text-center">' +
                        '<a class="btn-floating waves-effect waves-light teal" href="#modal2" id="' + response[i].id +'" onclick="replaceRecipe(this.id)"><i class="material-icons">add</i></a>'+
                        '</div>'+
                        '</div>' +
                        '</div>')
                }
            }
        })
    });





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
  console.log(id);
  console.log("clicked");
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
                $(".search-result").append('<div class="col s12 m6">'+
                    '<div class="card small">' +
                    '<div class="card-image">' +
                    '<img src="recipes_images/' + response[i].logo +'">' +
                    '</div>' +
                    '<div class="card-content">' +
                    '<p>' +response[i].name +'</p>' +
                    '</div>' +
                    '<div class="card-action text-center">' +
                    '<a class="btn-floating waves-effect waves-light teal"><i class="material-icons">add</i></a>'+
                    '</div>'+
                    '</div>' +
                    '</div>')
            }
        }
    });
}