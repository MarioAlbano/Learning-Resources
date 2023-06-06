const express = require("express");
const app = express();
const port = 8080;

app.get("/bem-vindo", (req, res) => {
  res.send("Seja bem vindo a rota '/bem-vindo'!");
});

app.get("/sobre", (req, res) => {
  const mensagemJSON = {
    mensagem: "Criado arquivo JSON com o Node.js",
    horario: new Date(),
  };
  res.json(mensagemJSON);
});

app.use((req, res) => {
  res.status(404).send("Página não encontrada. Por favor tente novamente!");
});

app.listen(port, () => {
  console.log("Sucesso ao iniciar o servidor");
});
