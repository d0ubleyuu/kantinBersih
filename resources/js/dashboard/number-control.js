function incrementValue() {
    let value = parseInt(document.getElementById(this.inputID).value, 10);
    value = isNaN(value) ? 0 : value;
    value++;
    document.getElementById(this.inputID).value = value;
}

function decrementValue() {
    let value = parseInt(document.getElementById(this.inputID).value, 10);
    value = isNaN(value) ? 0 : value;
    if (value > 0) {
        value--;
    }
    document.getElementById(this.inputID).value = value;
}

export default (inputID) => ({
    inputID: inputID,
    incrementValue: incrementValue,
    decrementValue: decrementValue,
});
