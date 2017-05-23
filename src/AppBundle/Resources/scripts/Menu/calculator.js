var Calculator = {
    calculate : function () {
        var modal = $("#modal1");

        var num = 0;
        var age = modal.find("#age").val();
        var height = modal.find("#height").val();
        var weight = modal.find("#weight").val();


        var gen = modal.find("input[name=gender]:checked").val();
        var ac = modal.find("input[name=activity]:checked").val();

        if (gen === 1) {
            num = ac * (66.47 + (13.75 * weight) + (5.0 * height) - (6.75 * age));
        }
        else {
            num = ac * (665.09 + (9.56 * weight) + (1.84 * height) - (4.67 * age));
        }
        $("#kcal").val(Math.round(num));
    },

    bind : function () {
        var self = this;
        $("#calculate").click(function () {
            self.calculate();
        })
    }
};