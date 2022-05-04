let number1 = 1;
let number2 = 2;
let number3 = 3;
let number4 = 4;

function printNumbers(...args) {
  for (let i = 0; i < args.length; i++) {
    console.log(args);
    console.log(args[i]);
  }
}

printNumbers(number1, number2, number1, number4);
console.log("pause");
printNumbers(1, 2, 3, 4, 5, 6, 7, 8, 9, 10);
printNumbers("Este é um texte", "Este é um exemplo");
