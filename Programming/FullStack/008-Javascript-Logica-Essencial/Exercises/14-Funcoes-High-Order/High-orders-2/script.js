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
