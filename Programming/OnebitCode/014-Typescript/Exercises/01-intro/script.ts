//Example Typescript Object
const spaceship: { name: string, velocity: number } = {
  name: 'Apollo',
  velocity: 250
}

function calculateSpeed(spaceship: { name: string; velocity: number; }, newSpeed: number) {
  spaceship.name = 'Helior';
}

calculateSpeed(spaceship, 250);