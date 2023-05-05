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

//Array in javascript
let myList = ["Mario", "Albano", "Pereira", "Navas", 27];
console.log(myList[2]); //Expected "Pereira"

//indexOf join pop shift push
console.log(myList.indexOf("Mario"));

let arrayList = myList.join(" - ");
console.log(arrayList);

myList.pop();
console.log(myList);

myList.shift();
console.log(myList);

myList.push("Brazilian");
console.log(myList);

//While
let whileVariable = 10;

while (whileVariable <= 20) {
  document.write(`<br>A variável está valendo ${whileVariable}`);
  whileVariable++;
}

document.write("<br><br>X está valendo 10! <br>");

//For
for (i = 10; i <= 20; i++) {
  document.write(`<br>A variável está valendo ${i}`);
}

//Switch
document.write(
  "<br>Escolha uma opção: 1 - Água 2 - Refrigerante 3 - Água de coco",
);
// const userOption = prompt("Qual a opção?");

switch (userOption) {
  case "1":
    alert("Você escolheu uma água");
    break;
  case "2":
    alert("Você escolheu um refrigerante");
    break;
  case "3":
    alert("Você escolheu uma água de coco");
    break;
  default:
    alert("Opção não identificada. Por favor tente novamente!");
}
