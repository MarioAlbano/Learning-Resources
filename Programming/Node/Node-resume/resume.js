/*Fundamentos
-Fundamentos do Javascript (objetos, arrays, condicionais etc.)
-JSON
-HTTP (status code, headers)
*/

/*Node.js
-Execução do Javascript fora do navegador
-V8
-Constroi APIs
-Single threaded, non-blocking (várias operações simultâneas)
*/

/*Vantagens
-Baixo custo memória
-Harmonia com o front-end
-Rápido, simples e escalável
-Mercado
*/

/*Módulos
-Podemos criar e importá-los
-Vem alguns pré-instalados (path, fs, http e etc.)
-Para importar, ex: const path = require('path'); const meuArquivo = require('./meu-arquivo.js')
*/

/*NPM
-Poder baixar módulos de terceiros
-armazenados no "node_modules"
-"package.json" lista todos os módulos instalados
-Comando úteis: npm init, npm install express, npm -g install nodemon
*/

/*Módulo 'path'
-path.basename: ler documento
-path.dirname: ler diretório
-path.extname: ler extensão arquivo
-path.join: adiciona caminho do diretório
 */

/*Módulo 'fs'
-fs.mkdir: Cria pasta
-fs.writeFile: Cria arquivo
-fs.appendFile: Altera um arquivo sem deleta-lo
*/

/*Status Code
-200: successfull
-201: created
-404: not found
-500: internal server error

 */

/*Anotações
-criar uma outro if para outra rota com json;
-instalar express, converter o mesmo código para express(mandar uma tag h1, mandar um JSON)
-conectar com o mongodb pela cloud, configurar banco na nuvem(guardar login e senha), instalar mongoose,  criar pasta src\database\connect.js
-dar require no mongoose, criar um async await no mongoose.conect(url_gerada_pela_nuvem, (error)=>{}); dar module.exports
-introdução a variáveis de ambiente; criar arquivo .env e adiciona-lo no gitignore. Criar login=asda e senha=asdas no arquivo; instalar a dependência dotenv pelo terminal, usar require e nome_variavel.config(), ir onde coloca a admin e senha e colocar process.env.nome_variavel_do_arquivo, nessa mesma string troca o nome da database;
-usar no arquivo index principal o arquivo do connect
*/
