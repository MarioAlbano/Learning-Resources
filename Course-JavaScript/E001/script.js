let calculator = {
    sum(x, y) {
        console.log(x + y);
    },

    sub(x, y) {
        console.log(x - y);
    },

    mult(x, y) {
        console.log(x * y);
    },

    divd(x, y) {
        console.log(x / y);
    }
}

calculator.sum(3, 2);
calculator.sub(55, 5);
calculator.mult(5, 5);
calculator.divd(10, 2);

let calculatorTwo = Object.create(calculator);

calculatorTwo.sum(10, 10);