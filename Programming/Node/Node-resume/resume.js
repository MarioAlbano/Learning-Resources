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

/*Passos
-iniciar o npm
-teste: criar e exportar módulos (module.exports, usar variavel com require em outro arquivo)
-usar nodemon (saber a diferença entre instalar globalmente e --save-dev, criar um script no package.json). Adicionar node_modules no git ignore
-testar require('path'): path.basename(__filename); path.dirname(__filename); path.extname(__filename); path.join(__dirname, "teste", "teste.html")
-testar require('fs'): fs.mkdir(__dirname, '/testePasta',(error) => {if(error){return ...} clg("criada com sucesso!")});
fs.writeFile(path.join(__dirname, '/testeArquivo', 'teste.html'), 'Olá mundo', (error) => {if(error)...});
fs.appendFile(path.join(__dirname, '/teste', '/teste.html'), "Adicionando informação sem sobreescrever o arquivo", (error)=>{if(error)...})
fs.readFile(path.join(__dirname, '/teste', 'teste.html'), 'utf8', (error, data)=>{if(error){return...} clg(data)})
*/
