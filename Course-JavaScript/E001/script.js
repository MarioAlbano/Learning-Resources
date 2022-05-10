const pessoa = {
  maos: 2,
}

console.log(Object.getPrototypeOf(pessoa));

const pessoaNova = Object.create(pessoa);

console.log(pessoaNova.maos);
console.log(pessoaNova.hasOwnProperty("maos"));
console.log(Object.getPrototypeOf(pessoaNova) === pessoa);