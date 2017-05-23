function Selector() {
    this.selector = "";
    this.setSelector = function (string) {
        return this.selector = string;
    };
    this.getSelector = function () {
        return this.selector;
    }
}