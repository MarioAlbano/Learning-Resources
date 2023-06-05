//npm init -y, npm add express, npm add nodemon -D
//add script for nodemon: "scripts": {"dev": "nodemon index.js"}

//importing express
const express = require("express");

//stating server
const server = express();

//parse incoming JSON requests
server.use(express.json());

//creating courses array
const courses = ["Javascript", "Java", "Python"];

//creating 'Create'
server.post("/cursos", (req, res) => {
  const courseName = req.body.name; //means that we will receive 'name' from JSON
  courses.push(courseName);

  return res.json(courses);
});

//creating all 'Read'
server.get("/cursos", (req, res) => {
  return res.json(courses);
});

//creating individual 'Read'
server.get("/cursos/:index", (req, res) => {
  const index = req.params.index; //means that we will receive index from params
  return res.json(courses[index]);
});

//creating 'Update'
server.put("/cursos/:index", (req, res) => {
  const index = req.params.index;
  const courseName = req.body.name;
  courses[index] = courseName;
  return res.json(courses);
});

//creating 'Delete'
server.delete("/cursos/:index", (req, res) => {
  const index = req.params.index;

  courses.splice(index, 1);
  return res.json(courses);
});

//listen for incoming request on port 3000
server.listen(3000);
