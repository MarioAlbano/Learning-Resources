let carteiraMotorista = prompt(
  "Você possui carteira de motorista regularizada?"
);
let idadeMotorista = parseFloat(prompt("Qual a sua idade?"));

if (idadeMotorista >= 18 && carteiraMotorista === "sim") {
  let cnhMotorista = prompt("Qual a sua CNH?");
  alert("Parabéns, você logou no sistema");
} else if (idadeMotorista >= 18 && carteiraMotorista === "nao") {
  alert("Você precisa tirar a carteira de motorista primeiro!");
} else {
  alert("Desculpe, você não tem nem idade suficiente e portanto não tem CNH");
}
