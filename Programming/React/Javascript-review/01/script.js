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

//Arrays in Javascript
let userInfo = ["Mario", "Albano", 27, "Single"];
console.log(userInfo);

//Arrays methods Javascript:

//forEach: for each element from an array doing something (When you need a loop inside array)
userInfo.forEach((item) => {
  console.log(item + " Info.");
});

//map: when you need to transform each element from an array
const userAccount = [0, 1, 2, 3, 4, 5];
const userAccountOperation = userAccount.map((item) => {
  return item * 3;
});
console.log(userAccountOperation);

//concat: when you need to group up two different arrays
const firstOfFive = [0, 1, 2, 3, 4, 5];
const lastOfTen = [6, 7, 8, 9, 10];
const totalOfTen = firstOfFive.concat(lastOfTen);
console.log(totalOfTen);

//push: Insert in the end of array
userInfo.push("push method here!");
console.log(userInfo);

//pop: Remove the last element from an array
userInfo.pop();
console.log(userInfo);

//Splice: when we need to put elements in the middle of array
const myFruitsExample = ["Banana", "Orange", "Apple", "Melon", "Lemon"];
myFruitsExample.splice(2, 0, "RandomFruit", "RandomFruit2");
console.log(myFruitsExample);

//Slice: when you need to cut an array. Tip: It's like dont have element 0 here
const animalsExample = ["Lion", "Tiger", "Eagle", "Dog", "Cat", "Bear"];
console.log(animalsExample.slice(0, 3));

//unshift: Insert on first position
userInfo.unshift("Data Science");
console.log(userInfo);

//shift: Remove the first position element
userInfo.shift();
console.log(userInfo);

//Join: When we need concatenating between elements of array
const joinExample = ["Vehicle: Warship", "Person: Captain Flint"];
console.log(joinExample.join(" = "));

//Loops

//For: Create a counter, put a limit on it, and decide if it will increase or decrease
for (i = 0; i <= 10; i++) {
  console.log(`${i} position`);
}

//While: You can create a loop requirements
let userCounterExample = 0;
let userCounterExample2 = 0;
while (userCounterExample2 < 5) {
  userCounterExample += 10;
  userCounterExample2++;
  console.log(userCounterExample);
}

//Do While: It's a different version of the For, but you need to create a counter variable
let myCounterExample = 0;
do {
  myCounterExample += 5;
  console.log(myCounterExample);
} while (myCounterExample <= 20);

//Switch: When you have a multiple choices, you can use switch statement
switchUserOption = 3;

switch (switchUserOption) {
  case 1:
    console.log("Option One");
    break;
  case 2:
    console.log("Option Two");
    break;
  case 3:
    console.log("Option Three");
    break;
  case 4:
    console.log("Option Four");
    break;
  case 5:
    console.log("Option Five");
    break;
  default:
    console("Number not founded");
}
