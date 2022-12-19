//Hospital Exercise

//Creating array
let hospitalQueue = ["Marcos", "Matheus", "Juan", "Carlos", "Giovanni", "D'Angelo"];

//Testing array
console.log(hospitalQueue);

//Asking option
userOption = prompt("Bem vindo ao hospital Cantareira!" + "\nQual opção deseja?" + "\n" + "\n1- Inserir novo paciente" + "\n2- Consultar paciente" + "\n3- Sair");

do {
  if (userOption = 1) {
    insertName = prompt("Qual o nome do novo paciente?");
    hospitalQueue.push(insertName);
  }
  else if (userOption = 2) {
    hospitalQueue.includes()
  }

  else if (userOption < 1 || userOption > 0) {
    alert("Opção não identificada. Por favor tente novamente!");
  }


} while (userOption != 3);

alert("Finalizando sistema... Até breve!");