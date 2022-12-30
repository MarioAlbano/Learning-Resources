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