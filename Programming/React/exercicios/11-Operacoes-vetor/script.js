//Using operators in vetors

//Map() to travel the array
let randomNumbers = [2, 5, 7, 19, 22, 1];

const doubleNumber = randomNumbers.map(function (item) {
  return item * 2;
})

console.log(doubleNumber); //Expected [4, 10, 14, 38, 44, 2]

//Using reduce() to sum in array
const sumVetor = randomNumbers.reduce(function (totalValue, nextItem) { return totalValue + nextItem });
console.log(sumVetor); //Expected 56

//Using find() to find item in array
const findItem = randomNumbers.find(function (item) {
  return item === 22;
})
console.log(findItem); //Expected 22, means that found an item