//Variables
const firstName = "Mario";
console.log(firstName);

let numberA = 20;
let numberB = 10;
const sum = numberA + numberB;

console.log(sum);
console.log(`Variável Nome: ${firstName}, Variável Soma: ${sum}`);

const NOME = "Nome Maiúsculo";
const Nome = "Nome Capitalizado";
const nome = "Nome Minúsculo";

console.log(NOME);
console.log(Nome);
console.log(nome);
console.log(numberA / numberB);
console.log(numberB % numberA);
console.log(numberA * numberB);

//Comment in Javascript = Sigle Line "//Comment Example Here" or  Multi line /*Comment Example Here*/

//Output values througth prompt
// const entryNumber = prompt("Qual o número que deseja gravar?");
// console.log(entryNumber);

//Output value througth document.write
document.write("Esse é um teste de Output");

//Arrays and arrays methods Javascript
let userInfo = ["Mario", "Albano", 27, "Single"];
console.log(userInfo);

//forEach: for each element from an array doing something
userInfo.forEach((item) => {
  console.log(item + " Info.");
});

//unshift: Insert on first position
userInfo.unshift("Data Science");
console.log(userInfo);

//shift: Remove the first position element
userInfo.shift();
console.log(userInfo);

//
