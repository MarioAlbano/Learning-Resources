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
