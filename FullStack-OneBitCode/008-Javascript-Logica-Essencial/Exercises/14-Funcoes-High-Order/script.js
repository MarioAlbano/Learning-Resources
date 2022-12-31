//High-Order functions example
function mathOperation(x, y, operation) {
  console.log("Realizando uma operação de soma...");
  const result = operation(x, y);
  return result;
}

function sumNumbers(x, y) {
  return x + y;
}

console.log(mathOperation(5, 4, sumNumbers));

//forEach is a High-Order function
const arrayList = ["Banana", "Maça", "Pêra", "Uva"];

arrayList.forEach(function readMe(element, index, array) {
  console.log(element,
    index,
    array);
});