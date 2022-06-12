let fruits = /\d+ (banana|maça|pera|melancia|laranja|uva|pessego)/;

console.log(fruits.test("011000001110101011001100 laranjas"));
console.log(fruits.test("5555 naranjas"));