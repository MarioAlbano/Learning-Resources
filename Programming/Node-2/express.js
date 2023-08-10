const express = require("express"); //Importing express
const app = express(); //Using instance
const PORT = 3030; //Creating port
app.listen(PORT, () => {
  console.log("Server funcionando");
});

app.get("/", (req, res) => {
  res.send("Testando o express");
});
