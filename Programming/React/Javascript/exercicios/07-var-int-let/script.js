// Example Var
for (var i = 0; i <= 10; i++) {
  console.log(`O valor de "i" é: ${i}`);
}

console.log(`Valor final: ${i}`);

//Example Let
for (let j = 0; j <= 10; j++) {
  console.log(`O valor de "j" é de ${j}`);
}

console.log(j); //Expected error

//Example const
const constantNumber = 10;
constantNumber = 100;
console.log(constantNumber); //Expected error