function SetBlockedIngredients(){
    this.ingredients = [];
    this.putIngredient = function (ingredient) {
        this.ingredients.push(ingredient);
    };
    this.pullIngredient = function (ingredient) {
        var index = this.ingredients.indexOf(ingredient);
        this.ingredients.splice(index, 1);
    };
    this.getIngredients = function () {
        return this.ingredients;
    }
}