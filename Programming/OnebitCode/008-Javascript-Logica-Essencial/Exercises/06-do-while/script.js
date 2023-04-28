//Creating variable velocity
carVelocity = 80;
alert(`Velocidade atual ${carVelocity} km/h`);

//Initializing loop
do {
  carVelocity -= 20;
  alert(`Velocidade reduzida para ${carVelocity}km/h`);
}
while (carVelocity > 0);

//Display info
alert(`Carro parou!`);