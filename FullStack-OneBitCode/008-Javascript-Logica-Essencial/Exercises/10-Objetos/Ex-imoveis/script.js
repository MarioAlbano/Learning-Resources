//Initializing array and option variable
propertieList = [];
userOption = 0;

//Starting loop
do {
  userOption = prompt("Bem vindo a Imóveis Cantareira!\n\n"
    + `Números de imóveis cadastrados: ${propertieList.length}\n\n`
    + "Selecione um opção:\n"
    + "1 - Cadastrar um imóvel\n"
    + "2 - Consultar um imóvel\n"
    + "3 - Sair do programa");

  //Signing up
  if (userOption == "1") {
    propertieEntry = {};

    propertieEntry.name = prompt("Qual o nome do cadastrante?");
    propertieEntry.rooms = prompt("Quantos quartos tem o imóvel?");
    propertieEntry.bathrooms = prompt("Quantos banheiros possuem o imóvel?");
    propertieEntry.garage = prompt("Possui garagem o imóvel?");

    //Asking to Confirm entry
    const userConfirm = confirm(`Confirme as seguintes opções:\n\nNome: ${propertieEntry.name}.\nQuartos: ${propertieEntry.rooms}.\nBanheiros: ${propertieEntry.bathrooms}.\nGaragem: ${propertieEntry.garage}.`);
    if (userConfirm == true) {
      propertieList.push(propertieEntry);
      alert("Imóvel registrado no sistema!");
    }
    else {
      alert("Retornando ao menu...");
    }
  }
  if (userOption == "2") {
    for (i = 0; i < propertieList.length; i++) {
      alert(`Imóvel ${i + 1}:\nPropietário: ${propertieList[i].name}.\nQuartos: ${propertieList[i].rooms}.\nBanheiros: ${propertieList[i].bathrooms}.\nGaragem: ${propertieList[i].garage}.`);
    }
  }

} while (userOption != 3)

alert("Saindo do programa.\nObrigado pela visita e até breve!...");
