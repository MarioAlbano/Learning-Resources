let primeNumberTest = 41;
let divisionNumber = 0;

for (let i = 0; i <= primeNumberTest; i++) {
    if (primeNumberTest % i == 0) {
        divisionNumber++;
    }
}

if (divisionNumber == 2) {
    console.log(`Número ${primeNumberTest} é primo`);
} else {
    console.log(`Número ${primeNumberTest} não é primo`);
}