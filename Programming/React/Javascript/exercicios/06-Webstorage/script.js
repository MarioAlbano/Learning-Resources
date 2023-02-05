// Example 1
// let userName = "";

// if (userName.length == 0) {
//   localStorage.name = prompt("Qual o seu nome?");
// }

// document.getElementById("divContainer").innerHTML = localStorage.name;
// localStorage.removeItem("nome");

// Example 2
let nome = "";
console.log(typeof localStorage.nome);
if (typeof localStorage.nome == "undefined") {
  localStorage.nome = prompt("Qual seu nome?");
}

nome = localStorage.nome;

document.getElementById("divContainer").innerHTML = nome;
