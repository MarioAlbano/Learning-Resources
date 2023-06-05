//Iniciando pacote: npm init -y
//Adicionar express: npm add express
//Query params = ?nome=NodeJS
//Route Params = /curso/2
//Request Body = {nome: "node", tipo: "Backend"}

const express = require("express"); //Buscando o express no node modules

const server = express(); //Iniciando o server

//CRUD: Create, Read, Update, Delete

const cursos = ["Javascript", "Java", "Python"];

server.get("/curso/:index", (req, res) => {
  //Dizendo que está esperando o route params por causa do /:id
  const index = req.params.index;

  return res.json(`Curso ${cursos[index]}`);
}); //Iniciando uma rota

server.listen(3000); //Ouvindo a porta 3000

//Instalar o programa insomnia para poder fazer requisições do tipo put ou delete
//Instalar o nodemon: npm add nodemon -D
//Ir no package.json, antes do dependencies, criar "scripts": {"dev": "nodemon index.js"}. Para rodar usar: npm run dev
