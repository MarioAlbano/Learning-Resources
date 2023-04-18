const name001 = "Mario Albano";

// Comment example
// let MyPrompt = prompt("Qual a sua idade?");

document.write(
  "<h2>Este é um exemplo de parágrafo criado com document.write<h2/>",
);

document.getElementById("id-principal").innerHTML =
  "Este é meu H1 principal com innerHTML";

// document.getElementById("button-principal").innerHTML = prompt(
//   "Qual o nome do segundo botão?",
// );

//Function example 1
function entry() {
  let area = document.getElementById("area-p");
  area.innerText =
    "Este é um texto criado por um innerText dentro de uma função";
}

//Function example 2
function entry2() {
  let secondaryArea = document.getElementById("id-secondary");

  if (secondaryArea.innerText == "" || secondaryArea.innerText == null) {
    secondaryArea.innerText = prompt("Qual o nome desse h2?");
  }
}
  