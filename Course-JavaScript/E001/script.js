let numero = 41;
let div = 0;

for (let i = 1; i <= numero; i++) {
  if (numero % i == 0) {
    div++;
  }
}
if (div === 2) {
  console.log(`${numero} é primo`);
} else {
  console.log(`${numero} não é primo`);
}
