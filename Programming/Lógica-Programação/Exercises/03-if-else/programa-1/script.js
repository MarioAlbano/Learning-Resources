fisrtCar = prompt("Digite o nome do primeiro carro");
secondCar = prompt("Digite o nome do segundo carro");
firstCarVel = parseFloat(prompt("Digite a velocidade do primeiro carro"));
secondCarVel = parseFloat(prompt("Digite a velocidade do segundo carro"));

if (firstCarVel > secondCarVel) {
  alert(`O carro ${fisrtCar} é o mais rápido, com velocidade de ${firstCarVel}km/h comparado com ${secondCarVel}km/h do carro ${secondCar}`);
}
else if (firstCarVel == secondCarVel) {
  alert(`Empate. Tanto o carro ${fisrtCar} e o carro ${secondCar} possuem ${firstCarVel}km/h de velocidade`);
}
else if (firstCarVel < secondCarVel) {
  alert(`O carro ${secondCar} é o mais rápido, com velocidade de ${secondCarVel}km/h comparado com ${firstCarVel}km/h do carro ${fisrtCar}`);
}