function sliceCaloriesInput() {
    var input = document.getElementById('kcal');
    input.oninput = function () {
        if (this.value.length > 4) {
            this.value = this.value.slice(0,4);
        }
    };
}

function fullPageSettings() {
    $('#fullpage').fullpage({
        scrollBar:true,
        hybrid: true,
        fitToSection:false
    });
}

function sliceCaloriesInputSize() {
    $('#kcal').each(function(){
        var value = $(this).val();
        var size  = value.length;
        size = size*3.5;
        $(this).css('width',size*3);
    });
}

