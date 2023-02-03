//Creating variables
const userInput = prompt("Por favor, entre com uma palavra.");
let userCheck = "";
console.log(userInput.length);

// Starting loop
for (i = userInput.length; i > 0; i--) {
  userCheck += userInput[i - 1];
}

//Display info
if (userInput == userCheck) {
  alert(`Entrou com a palavra "${userInput}". A palavra de trás para frente é: "${userCheck}".\nResultado: É uma palavra palíndromo!`);
}
else if (userInput != userCheck) {
  alert(`Entrou com a palavra "${userInput}". A palavra de trás para frente é: "${userCheck}".\nResultado: Não é uma palavra palíndromo!`);
}