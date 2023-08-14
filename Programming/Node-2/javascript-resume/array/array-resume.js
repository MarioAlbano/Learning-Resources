//map example
const arrayPersons = [
  { nome: "Abreu", idade: 22 },
  { nome: "Maverick", idade: 40 },
  { nome: "Merv", idade: 28 },
  { nome: "Leo", idade: 33 },
];

const doubleAge = arrayPersons.map((item) => item.idade * 2);

console.log(doubleAge);

//spread operator example
const addToList = [...arrayPersons, doubleAge];
console.log(addToList);

//forEach Example
const myNumbers = [0, 1, 2, 3, 4];

myNumbers.forEach((item) => {
  console.log(item * 2);
});

//filter example
const filterExample = myNumbers.filter((item) => item % 2 === 0);
console.log(filterExample);

//find example
const findExample = myNumbers.find((number) => number > 2);
console.log(findExample);

//reduce example
const sumNumbers = myNumbers.reduce((accumulator, currentValue) => {
  return accumulator + currentValue;
}, 5);
console.log(sumNumbers);

//keys example
const myObject = {
  objectName: "Name-01",
  age: 20,
  occupation: "Developer",
};

const keysExample = Object.keys(myObject);
console.log(keysExample);

//sort example
const sortExample = myNumbers.sort((a, b) => {
  return a - b;
});

const numberExample2 = [14, 22, 2, 55, 3, 7];
const sortExample2 = numberExample2.sort((a, b) => {
  return b - a;
});

console.log(sortExample);
console.log(sortExample2);

//some and every example
const numberExample3 = [10, 25, 5, 40, 15];
const someExample = numberExample3.some((item) => item > 30);
console.log(someExample);

const everyExample = numberExample3.every((item) => item > 5);
console.log(everyExample);

//flatMap example
const slittedArray = [
  [1, 2],
  [3, 4],
  [5, 6],
  [7, 8],
];

const flatMapExample = slittedArray.flatMap((item) => item);
console.log(flatMapExample);
