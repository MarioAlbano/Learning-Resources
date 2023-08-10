const express = require("express"); //Importing express
const app = express(); //Using instance
const PORT = 3030; //Creating port

app.get("/", (req, res) => {
  res.send("Testando o express");
});

app.get("/:id", (req, res) => {
  res.send(`Route Params exemplo ${req.params.id}`);
});

app.post("/user/", (req, res) => {
  const data = "João Felix";
  res.send(data);
});

app.listen(PORT, () => {
  console.log("Server funcionando");
});

//Novo endpoint criar e deletar,
