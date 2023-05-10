//Initialize a project with 'npm init -y'
//Install express, mongoose, body-parser (in terminal: 'npm install express mongoose'

//Importing express and mongoose
const express = require("express");
const mongoose = require("mongoose");

//Initialize express
const app = express();
app.use(express.json());

//Conecting data base, using a promise that return a message if it's sucessful or failed
mongoose
  .connect("mongodb://localhost:27017/", {
    useNewUrlParser: true,
    useUnifiedTopology: true,
  })
  .then(() => console.log("Banco de dados conectado"))
  .catch((err) => console.log(err));

//Callback function that verify and info the user about the port
const port = process.env.PORT || 3000;

app.listen(port, () => console.log(`Server iniciado na porta ${port}`));
