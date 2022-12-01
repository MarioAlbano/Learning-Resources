// Creating variables
let userOption = 0;
let moneyDifference = 0;
let moneyAvailable = parseFloat(prompt("Qual a sua quantidade de dinheiro que deseja informar?"));

//Initializing Loop
do {
  userOption = prompt("Escolha uma opção: \n1 - Adicionar quantia.\n2 - Retirar quantia.\n3 - Sair.")
  //Add
  if (userOption == 1) {
    moneyDifference = parseFloat(prompt(`Saldo de ${moneyAvailable}. Quando gostaria de adicionar?`));
    moneyAvailable += moneyDifference;
    alert(`Adicionado ${moneyDifference} reais e agora seu saldo é de ${moneyAvailable} reais.`)
  }
  //Remove without pass the limit
  else if (userOption == 2) {
    moneyDifference = parseFloat(prompt(`Saldo de ${moneyAvailable}. Quando gostaria de remover?`));
    if (moneyDifference > moneyAvailable) {
      alert(`Operação cancelada, você não possui esse saldo disponível com a diferença de -${(moneyDifference - moneyAvailable)} reais. Por favor tente denovo.`);
    } else {
      moneyAvailable -= moneyDifference;
      alert(`Removido ${moneyDifference} reais e agora seu saldo é de ${moneyAvailable} reais.`)
    }
  }
}
while (userOption != 3);

//Display message
alert(`Seu saldo atual é de ${moneyAvailable}. Obrigado pela sua visita!`);
alert("Finalizando o sistema...");