/*
//JSON
-JavaScript Objec Notation
-São os dados estruturados

//HTTP Codes
-1xx: Informations
-2xx: Success
-3xx: Redirection
-4xx: Client Error

//Criando API
-Usar 'npm init -y'
-Instalar Express
-Importar Express

Para criar uma API:
*/

//Importando Express
const express = require("express");

//Usando uma função do express
const server = express();

//Usando uma requisição GET. Req para requisitar info, Res uma resposta pro front
server.get("/curso/:id", (req, res) => {
  const nome = req.query.nome; //Retornando após o "="
  const id = req.params.id;

  return res.json({ curso: `Aprendendo ${id}` }); //Usando uma resposta devolvendo Objeto
});
//Ouvindo a porta 3000
server.listen(3000);

//Query params = ?nome=NodeJS
//Route Params = /curso/2
//Request Body = {nome: 'NodeJS', tipo:'Backend'}
