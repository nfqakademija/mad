function updateValue(par1, par2){
    var value = document.getElementById(par2).value;
    document.getElementById(par1).innerHTML = value;

    return value;
}

function updateMenu() {
    var ingredients = blockedIngredients.getIngredients();
    var mealTimes =  updateValue("meal", "mealTime");
    var daysCount =  updateValue("days", "daysCount");
    var calories = document.getElementById("kcal").value;

    var days = ['Pirma diena', 'Antra diena', 'Trečia diena', 'Ketvirta diena', 'Penkta diena', 'Šešta diena', 'Septinta diena', 'Aštunta diena', 'Devinta diena', 'Dešimta diena', 'Vienuolikta diena', 'Dvylikta diena',
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

            var daysUl = [];

            $menuList = $("#scroll").empty();
            for (var i = 0; i < daysCount; i++){

                var idOfUl = "sort" + (i + 1);
                $menuList.append('<ul id="' + idOfUl + '" class="connected menu sort"></ul>');

                $ul = $("#" + idOfUl);
                $ul.append('<li class="disabled day"><p class="day">' + days[i] + '</p></li>');
                for(var j = start; j < end; j++){
                    daysUl.push(i+1);
                    $ul.append(
                        '<li class="menu">' +
                        '<img src="recipes_images/'+ response[j].logo+ '" class="menu-img">' +
                        '<a onclick="showRecipe(this)"><p class="menu-name">' + response[j].name + '</p></a>' +
                        '<div class="li-setting">' +
                        '<input type="number" class="portion" value="4">' +
                        '<label class="portion">porc.</label>' +
                        '<a href="#modal2"><button class="action changeRecipe"><img src="images/icons/change.png" class="action"></button></a>' +
                        '<button class="action deleteLi" onclick="deleteLi()"><img src="images/icons/delete.png" class="action"></button>' +
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

            var i = 0;
            $li =  $(".table li.menu");
            $li.each(function (key, elem) { $(elem).data({"id": response[i].id, "day": daysUl[i]}); i++} );

        }
    })
}

$(".changeRecipe").on('click', function(e){
    e.preventDefault();
    var id = $(this).closest('li').data("id");
    var day = $(this).closest('li').data("day");
});

function IdAndDay() {
    this.id = "";
    this.day = "";
    this.setId = function (id) {
        this.id = id;
    };
    this.setDay = function (day) {
        this.day = day;
    };
    this.getId
}