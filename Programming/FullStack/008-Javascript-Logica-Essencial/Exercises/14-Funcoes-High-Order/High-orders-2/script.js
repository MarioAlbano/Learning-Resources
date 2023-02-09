//Creating a High-Order function
function highFunction(a, b, Operation) {
  console.log("Fazendo uma operação");
  const valuesOperation = Operation(a, b);
  return valuesOperation;
}

function sumFunction(a, b) {
  console.log("Fazendo uma soma");
  return a + b;
}

console.log(highFunction(2, 3, sumFunction));

//Another example of a High-Order function it's a forEach() function
let myArray = ["Maça", "Pera", "Banana", "Morango"];

myArray.forEach((justARandomNameForTestingPorpose) => {
  console.log(justARandomNameForTestingPorpose + " É uma fruta");
});
