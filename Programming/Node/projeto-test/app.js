//Installing necessary packages
const express = require("express");
const mongoose = require("mongoose");

//Initializing express
const app = express();

//Connecting to the database
mongoose
  .connect("mongodb://localhost:27017", { userNewUrlParser: true })
  .then(() => {
    console.log("MongoDB connected");
  })
  .catch((error) => {
    console.error("Erro!");
  });
