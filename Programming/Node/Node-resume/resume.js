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
-Criar o user Schema (criar pasta models e dentro dele o scheme); new mongoose.Schema. 
-Criar o Model: mongoose.model
-Endpoints: rotas
-usar UserModel.create(req.body)
-testar a rota com o postman, adicionar async await e enviar dados
-criar um endpoins para GET
 */
