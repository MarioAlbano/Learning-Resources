let firstNumber = prompt("Digite o primeiro número");
firstNumber = parseFloat(firstNumber)
let secondNumber = prompt("Digite o segundo número");
secondNumber = parseFloat(secondNumber);

alert(`Soma: ${(firstNumber + secondNumber)}, subtração: ${(firstNumber - secondNumber)}, divisão: ${(firstNumber / secondNumber)}, multiplicação: ${(firstNumber * secondNumber)}, resto da divisão: ${firstNumber % secondNumber}.`);