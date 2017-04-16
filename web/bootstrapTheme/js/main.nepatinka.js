

function showSelectedValues()
{
    var sarasas = ($("input[name=maistas]:checked").map(
        function () {return this.value;}).get().join(", "));
    $("#sarasas").html(sarasas);

}