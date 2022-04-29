let pessoa = {
  nome: "Mario",
  idade: 25,
  localidade: "Brasil",
  faculdade: "Ciências da computação",
};

let residencia = {
  pais: "Brasil",
  cidade: "São Paulo",
  município: "Mairiporã",
  Rua: "Rua logo ali, 246",
};

let residenciaCopia = { copia: "Somente um teste aqui" };

console.log(pessoa);
console.log("residencia sem método");
console.log(residencia);

Object.assign(residencia, residenciaCopia);
//Copia os elementos do segundo para o fim do primeiro
console.log("Agora com o método Object.assign");
console.log(residencia);
