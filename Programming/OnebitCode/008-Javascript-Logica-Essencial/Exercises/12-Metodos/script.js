const personObject = {
  personName: "Mario",
  personAge: 27,
  // personObject.personName = "Romário" //Expected error here
}

function recursiveFunction(num) {
  console.log(`Número ${num}`);
  if (num == 0) {
    return 1;
  }
  else if (num == 1) {
    return 1;
  }
  else {
    return num * recursiveFunction(num - 1);
  }
}
console.log(recursiveFunction(5));

//Another example recursive function
function anotherRecursive(num) {
  if (num <= 100) {
    let count = num * 2;
    console.log(count);
    anotherRecursive(count);
  }
}

(anotherRecursive(2)); // Expected output: 4, 8, 16, 32, 64, 128