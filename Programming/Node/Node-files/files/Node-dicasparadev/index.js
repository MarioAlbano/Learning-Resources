/*
//O que precisa saber:
-Fundamentos do JavaScript (Objetos, Arrays, Condicionais)
-JSON
-HTTP (status code, headers)


//NodeJS
-Executa Javascript fora do navegador
-Utiliza a V8
-Utilizado para contruir API

//Como funciona
-Possui apenas um núcleo (single threaded)
-Suporta várias operações simultâneas (non-blocking)

//Módulos
-Podemos criar nossos próprios módulos (nossos arquivos) e importá-los
-O Node.js vem com módulos pré-instalados (path, fs, http etc.)
*/

//Exemplo path no node
const path = require("path");
const myFile = require("./meu-arquivo.js");

/*
//NPM - Node Package Manager
-Podemos instalar módulos d terceiros utilizando o NPM
-Esses módulos ficam em 'node_modules'
-'package.json' lista todos os módulos que instalamos pelo NPM

//Usando o NPM
-npm init (Cria o package.json)
-npm install express (Instala um pacote localmente, ou seja, não terá se queremos para um outro projeto)
-npm -g install nodemon (Instala um pacote globalmente, ou seja, em todos os projetos)

//Iniciando
-Instalar o Node, testar no terminal com: 'node -v'
-Começar com o 'npm init'
*/
