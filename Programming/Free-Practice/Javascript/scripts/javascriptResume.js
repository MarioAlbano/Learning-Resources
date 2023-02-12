//Example with var
var userVariable = "VarType";
//Example with let
let userName = "Jonny";
//Example with const
const userComputer = "Windows";

//String example
let inputString = "This is a string";

//Number example
const inputNumber = 14;
let PI = 3.1415;

//Boolean example
const frontEnd = true;
let userIsAmerican = false;

//Object examples
let MarioAlbano = {
  Name: "Mario albano",
  Age: 27,
  frontEnd: true,
};
console.log(MarioAlbano.Age);
console.log(MarioAlbano.Name);
console.log(MarioAlbano.frontEnd);

//Function example
function sayMyName() {
  console.log("Mario");
}

//Undefined valor example
let undefinedText;
console.log(undefinedText);

//Null example
let nullText = null;
console.log(nullText);

//Operator example
let givingValeue;
givingValeue = "Now this variable have a value";
let randomNumber = 1;
randomNumber += 1;
console.log(randomNumber);

randomNumber *= 2;
console.log(randomNumber);
/*More Operators Example: ++, --, 0, +, %
Comparison Operators: ==, !=, ===, !==, >, >=, <, <=*/

//If conditional example
let numberForTest = 0;
console.log(numberForTest);

if (numberForTest < 1) {
  numberForTest++;
  console.log(numberForTest);
}

//Example for with array, with push() method
let arrayTesting = [];
for (i = 0; i < 10; i++) {
  arrayTesting.push(i);
  console.log(arrayTesting);
}

//Arrays Methods: concat(), join(), push(), pop(), shift(), slice(), splice(), reverse(), unshift()
let exampleArray = [1, 2, 3, 4, 5];
let exampleTwoArray = [6, 7, 8, 9, 10];

let groupedArray = exampleArray.concat(exampleTwoArray);
console.log(groupedArray);

const joinedArray = groupedArray.join(" - ");
console.log(joinedArray);

const unshiftExample = groupedArray.unshift("Unshift Example!");
console.log(groupedArray);

const pushExample = groupedArray.push("Push Example Here!");
console.log(groupedArray);

groupedArray.push("I will be deleted");
console.log(groupedArray);
const popExample = groupedArray.pop();
console.log(groupedArray);

const reversedArray = groupedArray.reverse();
console.log(groupedArray);

//Splice syntax: splice(starts, delete, "insertelemente here", "Alternatively another element here");
const splicedArray = groupedArray.splice(2, 0, "Splice example here!");
console.log(groupedArray);

//Slice syntax: slice(starts, end); If negative, the count will be started in the end of array. Slice will create a new array
let sliceArray = groupedArray.slice(0, 4);
console.log(sliceArray, " ", groupedArray);

//For exmaple
for (i = 0; i <= 5; i++) {
  console.log(`Eu sou o contador ${i}`);
}

// while example
whileCounter = 0;
while (whileCounter <= 5) {
  console.log(`Eu sou o contador ${whileCounter}`);
  whileCounter++;
}

// Do ... While example
let doCounter = 0;
do {
  console.log(doCounter);
  doCounter++;
} while (doCounter <= 5);
