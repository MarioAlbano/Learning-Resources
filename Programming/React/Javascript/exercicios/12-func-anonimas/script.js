//Example anonymous function with arrow
const randomNumbers = [2, 3, 4, 5, 7, 8, 8, 8];

const sumArray = randomNumbers.reduce((totalNumber, firstNumber) => totalNumber + firstNumber);
console.log(sumArray); //Expected 45