const path = require("path");

//Apenas o nome do arquivo
const fileName = path.basename(__filename);
console.log(fileName);

//Diretório atual
const fileFolder = path.basename(__dirname);
console.log(fileFolder);

//Extensão do arquivo
//Criar objeto Path
//Juntar caminhos de arquivos

//No fs:
//Criar uma pasta com promisse
//Criando um arquivo
//Adicionar à um arquivo(appendfile)
//Ler arquivos

//Criando servidor:
//Dar require no http, definir porta, createServer com if nas rotas com '/home' mandando uma tag e '/users' mandando um JSON convertido de um objeto.
//Fazer o mesmo código com o Express
//Configurar o mongodb para a cloud
