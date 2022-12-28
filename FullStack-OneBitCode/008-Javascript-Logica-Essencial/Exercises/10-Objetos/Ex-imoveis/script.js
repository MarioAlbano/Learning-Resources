//Creating object function
function registerEntry(name, propertieRoom, propertieBathroom, propertieGarage) {
  this.name = name;
  this.propertieRoom = propertieRoom;
  this.propertieBathroom = propertieBathroom;
  this.propertieGarage = propertieGarage;
}

let propertieList = [];
let userOption = 0;

do {
  userOption = prompt("Selecione a opção: 1 - Registrar, 2 - Consultar, 3 - Sair");
  if (userOption == 1) {
    let firstAsk = prompt("Qual seu nome?");
    let secondAsk = prompt("Qual seu nome?");
    let thirdAsk = prompt("Qual seu nome?");
    let fourthAsk = prompt("Qual seu nome?");

    const newEntry = new registerEntry(firstAsk, secondAsk, thirdAsk, fourthAsk);
    propertieList.push = newEntry;
  }
  console.log(propertieList);
} while (userOption != 3);

console.log(userOne);