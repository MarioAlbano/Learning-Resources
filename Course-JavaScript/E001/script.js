let recebe = 5;
let div = 0;

for (i = 1; i <= recebe; i++) {
  console.log(i);
  console.log("Divisão é" + div);
  if (recebe % i == 0) {
    div++;
  }
}

if (div == 2) {
  console.log(`${recebe} É um número primo!`);
} else {
  console.log(`${recebe} Não é um número primo!`);
}
