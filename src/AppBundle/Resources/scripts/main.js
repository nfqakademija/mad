/*!
 * jQuery UI Touch Punch 0.2.3
 *
 * Copyright 2011–2014, Dave Furfero
 * Dual licensed under the MIT or GPL Version 2 licenses.
 *
 * Depends:
 *  jquery.ui.widget.js
 *  jquery.ui.mouse.js
 */
!function(a){function f(a,b){if(!(a.originalEvent.touches.length>1)){a.preventDefault();var c=a.originalEvent.changedTouches[0],d=document.createEvent("MouseEvents");d.initMouseEvent(b,!0,!0,window,1,c.screenX,c.screenY,c.clientX,c.clientY,!1,!1,!1,!1,0,null),a.target.dispatchEvent(d)}}if(a.support.touch="ontouchend"in document,a.support.touch){var e,b=a.ui.mouse.prototype,c=b._mouseInit,d=b._mouseDestroy;b._touchStart=function(a){var b=this;!e&&b._mouseCapture(a.originalEvent.changedTouches[0])&&(e=!0,b._touchMoved=!1,f(a,"mouseover"),f(a,"mousemove"),f(a,"mousedown"))},b._touchMove=function(a){e&&(this._touchMoved=!0,f(a,"mousemove"))},b._touchEnd=function(a){e&&(f(a,"mouseup"),f(a,"mouseout"),this._touchMoved||f(a,"click"),e=!1)},b._mouseInit=function(){var b=this;b.element.bind({touchstart:a.proxy(b,"_touchStart"),touchmove:a.proxy(b,"_touchMove"),touchend:a.proxy(b,"_touchEnd")}),c.call(b)},b._mouseDestroy=function(){var b=this;b.element.unbind({touchstart:a.proxy(b,"_touchStart"),touchmove:a.proxy(b,"_touchMove"),touchend:a.proxy(b,"_touchEnd")}),d.call(b)}}}(jQuery);
var $j = jQuery.noConflict();

$j( document ).ready(function() {
    $('#sort').sortable();
    $('#sort1').sortable();

    $(function() {
        $( "#sort, #sort1" ).sortable({
            connectWith: ".connected"
        }).disableSelection();
    });

    $("ul").on("click", "button", function(e) {
        e.preventDefault();
        $(this).parent().remove();
    });


    $('.modal').modal();
    $('#kcalclick').click(function(){
        $('#modal1').modal('open');
    });
});

window.onload = function(){
    var myInput1 = document.getElementById('sk');
    myInput1.oninput = function () {
        if (this.value.length > 1) {
            this.value = this.value.slice(0,1);
        }
    };
    var myInput2 = document.getElementById('sk1');
    myInput2.oninput = function () {
        if (this.value.length > 1) {
            this.value = this.value.slice(0,1);
        }
    };
    var myInput3 = document.getElementById('kcal');
    myInput3.oninput = function () {
        if (this.value.length > 4) {
            this.value = this.value.slice(0,4);
        }
    };
    

    var calculate = document.getElementById("calculate");
    calculate.onclick = function () {
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
    }
};

