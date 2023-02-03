//Testing while
let userNumber = 0;
while (userNumber <= 10) {
  console.log(`Este é o valor da variável: ${userNumber}`);
  userNumber++;
}

//Testing for
let userVariable = 0;
for (i = 0; i < 10; i++) {
  console.log(i);
  userVariable++;
}
console.log(userVariable);

//Testing for with outside variable
for (x = userVariable; x <= 20; x = x + 2) {
  console.log(`X vale:${x} e I vale:${userVariable}`);
  userVariable++;
}

//Testing Switch
function foodProgram() {
  let userOption = parseInt(prompt("Bem vindo ao Restaurante Minas São Paulo!\n\nDigite uma opção: 1 - Frango, 2- Atum, 3 - Feijoada, 4 - Kibe"));

  switch (userOption) {
    case 1:
      console.log("Saindo uma refeição de Frango!");
      break;
    case 2:
      console.log("Saindo uma refeição de Atum!");
      break;
    case 3:
      console.log("Saindo uma refeição de Feijoada!");
      break;
    case 4:
      console.log("Saindo uma refeição de Kibe!");
      break;
    default:
      console.log("Opção inválida. Por favor leia com atenção e tente novamente");
  }
}

foodProgram();