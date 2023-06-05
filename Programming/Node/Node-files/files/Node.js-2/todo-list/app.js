const express = require("express"); //Importando o Express
const app = express(); //Dentro de app temos todos os métodos referente ao servidor

app.use(express.json()); //Middleware que verifica se existe um json e se deve deixar disponível no body

const log = (req, res, next) => {
  console.log(req.body);
  console.log(`Data: ${Date.now()}`);
  next();
};

//Criando uma rota para agir diante de uma determinada ação
app.get("/", (req, res) => {
  res.send("<h1>Minha lista de tarefas!</h1>"); //Enviar uma tag h1
});

//Criando uma nova rota, usando JSON quando acessado o link/json
app.get("/json", (req, res) => {
  console.log(req.body);
  res.json({ title: "Título 1", done: "Ainda não" });
});

app.listen(3000, () => {
  console.log("Servidor foi iniciado");
}); //Dando início ao servidor, ouvindo a porta 3000

//Instalaremos o nodemon para não ter que dar reload no servidor (npm install nodemon --save-dev, depois npx nodemon,)

//Instalar postman. Subir servidor (nodemon file_name.js)
