//npm init -y, npm add express, npm add nodemon -D
//importing express
const express = require("express");
//stating server
const server = express();

//creating courses array
const courses = ["Javascript", "Java", "Python"];

//listen server
server.listen(3000);
