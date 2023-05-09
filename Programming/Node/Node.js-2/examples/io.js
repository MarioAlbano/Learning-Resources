//Entrada e saída de dados
const process = require("process"); //Importando a process. Usamos o process para entrada de parâmetros
console.log(process.argv); //Retorna um array de linha de comando pelo node

process.stdin.on("data", (keyboard) => {
  console.log("Por favor digite seu nome");
  process.stdout.write(`Texto do usuário: ${keyboard}`); //Escrevendo info no terminal

  process.exit(); //Para parar a execução
}); //Entrada de dados
