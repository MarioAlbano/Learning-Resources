//setInterval is infinite and we can create clearInterval(variableName) to stop. setTimeOut it´s only one attempt

function randomInterval() {
  document.write("<br> Um intervalo está sendo chamado");
}

let threeSeconds = setInterval(randomInterval, 3000);
clearInterval(threeSeconds);

// setTimeout(randomInterval, 1000);

//webStorage save info after the user close the browser. local and session

// localStorage.setItem("nome", "Mario");
// console.log(localStorage.getItem("nome"));
// localStorage.removeItem("nome");
// console.log(localStorage.getItem("nome"));

// localStorage.nome = "Mario Albano";
// console.log(localStorage.nome);
// localStorage.removeItem("nome");
// console.log(localStorage.nome);

if (localStorage.nome == null) {
  localStorage.nome = prompt("Qual o nome do local storage?");
} else {
  document.getElementById("area-p").innerHTML = localStorage.nome;
}

localStorage.list = [1, 2, 3, 4];
console.log(localStorage.list);

//var let and const
const varExample = 1;
if (varExample == 1) {
  var varExample2 = 2;
}
console.log(varExample2);

const letExample = 1;
if (letExample == 1) {
  let letExample2 = 2;
}
// console.log(letExample2); Expected error

// letExample = "3"; Expected error
console.log(`Template literals example`);

//Destructuring (Dont affect the orginial array)
const personA = {
  name: "Mario",
  age: 27,
  country: "Brazil",
};
console.log(personA);

let { age } = personA;
console.log(age);
let { name, country } = personA;
console.log(name, country);
let { name: MyName, country: MyCountry } = personA;
console.log(MyCountry, MyName);

const newArray = ["Jonnhy", "Sonia", "Cassie"];

let { 0: joao, 1: sonia, 2: cassia } = newArray;
console.log(joao, sonia, cassia);

let [joao1, sonia2, cassia2] = newArray;
console.log(joao1, sonia2, cassia2);

//Spread Operator
const Array1 = [0, 1, 2, 3];
const Array2 = [...Array1, 4, 5, 6, 7];

console.log(Array1);
console.log(Array2);

const personB = {
  ...personA,
  isSingle: true,
  areHuman: true,
  hobby: "Video games",
};
console.log(personB);

const glassworkPattern = {
  name: "Mario",
  age: 27,
  experience: true,
};

function glassworkRegister(entry) {
  let employee = {
    ...entry,
    id: 1294,
    headquarters: "São Paulo",
  };

  return employee;
}

console.log(glassworkRegister(glassworkPattern));

//Rest Operator
const restFunction = (...entryNames) => {
  console.log(entryNames);
};

restFunction("Mario", "Albano", "Pereira", "Navas");

const restFunctionNumbers = (...entryNumbers) => {
  console.log(entryNumbers);
};
restFunctionNumbers(1, 2, 3, 4, 5, 6, 7);

//Array operations
//Map
const mylist = [0, 1, 2, 3, 4, 5];
const finalList = [6, 7, 8, 9, 10];

const mapFuncExample = mylist.map((item, index) => {
  return item * 3;
});
const mapFuncExample2 = mylist.map((item, index) => {
  return item + index;
});
console.log(mapFuncExample);
console.log(mapFuncExample2);

const sumArray = mylist.reduce((item, index) => {
  return item + index;
});
console.log(sumArray);

const findExample = finalList.find((item) => {
  return item === 10;
});
console.log(findExample);

const findExample2 = finalList.find((item) => {
  return item === 100;
});
console.log(findExample2); //Expecte undefined

//includes, endsWith startsWith
const testArray01 = ["John", "Wick", "Dog"];
console.log(testArray01.includes("John"));
console.log(testArray01.includes("The Rock"));

const randomName = "Fabricia";
console.log(randomName.endsWith("cia"));
console.log(randomName.endsWith("Y"));
console.log(randomName.startsWith("Fa"));
