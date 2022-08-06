const namePilot = prompt("Olá piloto. Qual o seu nome?");
let velocityShip = 0;

const questionPilot = prompt("Qual a velocidade desejada para a nave?");
velocityShip = questionPilot;

const confirmPilot = confirm(`Deseja navegar a ${velocityShip}?`);

if (velocityShip <= 0) {
    alert("Nave está parada. Considere partir e aumentar a velocidade");
}
else if (velocityShip < 40) {
    alert("Você está devagar, podemos aumentar mais");
}
else if (velocityShip >= 40 && velocityShip < 80) {
    alert("Parece uma boa velocidade para manter");
}
else if (velocityShip >= 80 && velocityShip < 100) {
    alert("Velocidade alta, considere diminuir");
}
else if (velocityShip >= 100) {
    alert("Velocidade perigosa. Controle automático forçado");
}