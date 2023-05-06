//Manipulando arquivos
const fs = require("fs"); //Chamando a biblioteca fs

fs.writeFile(
  "teste.txt",
  "Testando criação de arquivos através do NodeJS",
  (err) => {
    console.log(err);
  },
); //Passando nome do arquivo, conteúdo e se caso der erro

fs.appendFile(
  "teste2.txt",
  "Testando criação de arquivos através do NodeJS",
  (err) => {
    console.log(err);
  },
); //appendFile coloca um conteúdo adicional

fs.rename("teste.txt", "testeRenomeado.txt", (err) => {
  console.log(err);
}); //rename altera o arquivo

fs.unlink("teste.txt", (err) => {
  console.log(err);
}); //remove o arquivo

console.log(__dirname); //Mostra o diretório que está
