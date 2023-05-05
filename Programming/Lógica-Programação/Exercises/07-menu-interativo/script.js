let userOption = 0;

do {
  userOption = prompt("Qual opção você deseja?\n1- Funcionalidade um\n2- Funcionalidade dois\n3- Funcionalidade três\n4- Funcionalidade quatro\n5- Encerrar programa");

  alert(`Opção escolhida ${userOption}`);
}
while (userOption != 5);

alert("Encerrando o programa");