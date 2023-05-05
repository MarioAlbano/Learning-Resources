//Initializing Cards Array
let cardList = [];//"2", "3", "4", "5", "6", "7", "8", "9", "10"
let userOption;

//System starting
alert("Boas vinda ao Royal Cards!");

//Initializing Loop
do {
  let showCards = "";
  for (i = 0; i < cardList.length; i++) {
    showCards += `"${cardList[i]}" `;
  }

  if (cardList.length > 0) {
    if (cardList.length == 1) {
      alert(`${cardList.length} Carta no baralho: ${showCards}.`);
    } else {
      alert(`${cardList.length} Cartas no baralho: ${showCards}.`);
    }
  } else {
    alert("Sem cartas restantes no baralho!");
  }

  userOption = prompt("Digite uma opção:" + "\n" + "1- Adicionar uma carta " + "\n" + "2- Puxar uma carta" + "\n" + "3- Sair");

  if (userOption == "1") {
    const newCard = prompt("Qual o nome da carta?");
    cardList.push(newCard);
  } else if (userOption == "2") {
    if (cardList != false) {
      const removedCard = cardList.pop();
      alert(`A carta retirada foi a ${removedCard}.`);
    }
    else {
      alert("Não existe mais cartas no baralho!");
    }
  }
  else if (userOption == "4") {
    alert("Desculpe, opção inválida. Tente novamente por favor.");
  }
} while (userOption != "3")

//Exiting program
alert("Saindo do sistema. Obrigado pela visita!");