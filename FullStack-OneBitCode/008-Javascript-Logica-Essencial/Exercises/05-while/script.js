//Declaring variables
const userName = prompt("Qual o seu nome?");
let userFirstAsk = prompt("Já visitou alguma cidade?");
let userLocations = "";

//Using while
while (userFirstAsk == "sim" || userFirstAsk == "Sim" || userFirstAsk == "SIM") {
  userLocations += prompt("Qual o nome da cidade?");
  userFirstAsk = prompt("Deseja adicionar outra cidade?");
  userLocations += ". ";
}

//Result alert
alert(`Nome: ${userName + "."}\nLocais: ${userLocations}`);