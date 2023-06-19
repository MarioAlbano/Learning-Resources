const mongoose = require("mongoose");
require("dotenv").config();

const username = process.env.MONGO_USERNAME;
const password = process.env.MONGO_PASSWORD;
console.log(username, password);

mongoose
  .connect(
    `mongodb+srv://${username}:${password}@database-teste.ucckxrh.mongodb.net/?retryWrites=true&w=majority`,
    { useNewUrlParser: true, useUnifiedTopology: true }
  )
  .then(() => console.log("Conectado ao MongoDB"))
  .catch((err) => {
    console.error(`Falha ao conectar com o banco de dados: ${err}`);
  });

module.exports = mongoose;
