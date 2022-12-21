//Initializing Cards Array
let cardList = ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10"];
let userOption;

//System starting
alert("Boas vinda ao Royal Cards!");

//Initializing Loop
do {
  let showCards = "";
  for (i = 0; i < cardList.length; i++) {
    showCards += `"${cardList[i]}" `;
  }
  alert(`${cardList.length} Cartas no baralho: ${showCards}.`);

  userOption = prompt("Digite uma opção:" + "\n" + "1- Adicionar uma carta " + "\n" + "2- Puxar uma carta" + "\n" + "3- Sair");

  if (userOption == "1") {
    const newCard = prompt("Qual o nome da carta?");
    cardList.push(newCard);
  } else if (userOption == "2") {
    const removedCard = cardList.pop();
    alert(`A carta retirada foi a ${removedCard}.`);
  }
  else if (userOption == "4") {
    alert("Desculpe, opção inválida. Tente novamente por favor.");
  }
} while (userOption != "3")

//Exiting program
alert("Saindo do sistema. Obrigado pela visita!");