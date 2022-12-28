//Creating functions for testing
function firstFunction() {
  console.log("Olá mundo!");
}

firstFunction();

function doulbleNumber(x = 0) {
  console.log(`Seu número ${x} vezes dois terá o resultado de ${x * 2}`);
}

doulbleNumber(3);
doulbleNumber();

//Testing object as parameter
const objectParameter = {
  nome: "Silva",
  telefone: "12345",
  email: "silva@outlook.com",
  senha: "54321"
}

function testingParameter(x) {
  console.log(x.nome);
}

testingParameter(objectParameter);