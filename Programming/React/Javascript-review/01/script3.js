//setInterval is infinite and we can create clearInterval(variableName) to stop. setTimeOut it´s only one attempt

function randomInterval() {
  document.write("<br> Um intervalo está sendo chamado");
}

let threeSeconds = setInterval(randomInterval, 3000);
clearInterval(threeSeconds);

// setTimeout(randomInterval, 1000);

//webStorage save info after the user close the browser. local and session

// localStorage.setItem("nome", "Mario");
// console.log(localStorage.getItem("nome"));
// localStorage.removeItem("nome");
// console.log(localStorage.getItem("nome"));

// localStorage.nome = "Mario Albano";
// console.log(localStorage.nome);
// localStorage.removeItem("nome");
// console.log(localStorage.nome);

if (localStorage.nome == null) {
  localStorage.nome = prompt("Qual o nome do local storage?");
} else {
  document.getElementById("area-p").innerHTML = localStorage.nome;
}

localStorage.list = [1, 2, 3, 4];
console.log(localStorage.list);
