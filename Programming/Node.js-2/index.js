/*Backend:
-Cuida dos dados
-Precisamos de uma estrutura que seja capaz de Receber e fornecer dados, validar, armazenar e assegurar consistência
-Front faz requisição que são ouvidas por um servidor web, que passa por um código e faz interação com banco de dados
*/

//Criando uma função e chamando no node
function returnName(name) {
  console.log(name);
}
returnName("Albano");

//Iniciando um Package.json: 'npm init -y'. Instalando biblioteca moment: npm install moment --save

const moment = require("moment"); //Importando biblioteca

function returnName2(name) {
  console.log(moment().format("HH:mm")); //Retornando a hora usando a biblioteca moment
}
returnName2();
