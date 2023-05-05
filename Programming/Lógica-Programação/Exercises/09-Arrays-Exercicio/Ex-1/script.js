//Initializing array
let listQueue = ["Stuart", "John", "Palacio", "Fred", "Kisaraji", "Alfred", "Mozart", "Francis"];
let optionUser = "";


//Initializing System
alert("Bem vindo a Medical Care!");

//Initializing loop
do {
  let showList = "";
  for (let i = 0; i < (listQueue.length); i++) {
    if (i == 0) {
      showList += `${i + 1}º: "${listQueue[i]}"`;
    } else {
      showList += ` , ${i + 1}º: "${listQueue[i]}"`;
    }
  }
  alert("Lista de pacientes atuais: " + "\n" + showList + ".");

  optionUser = prompt("Digite uma opção" + "\n" + "1 - Adicionar novo paciente" + "\n" + "2 - Consultar paciente" + "\n" + "3 - Sair");

  //Option select
  if (optionUser == 1) {
    let newName = prompt("Qual o nome do novo paciente?");
    listQueue.push(newName);
  }
  else if (optionUser == 2) {
    let removeName = listQueue.shift();
    alert(`Removendo o primeiro paciente "${removeName}".`);
  }
  else if (optionUser == 3) {
    alert("Saindo do sistema... Obrigado!")
  }
  else if (optionUser != 1 || optionUser != 2 || optionUser != 3) {
    alert("Desculpe, opção inválida. Tente novamente por favor.");
  }
} while (optionUser != 3);