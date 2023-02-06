const setPilot = (newPilot: string, spaceship: { name?: string; pilot: string; speed?: number; inMission?: boolean; }) => {
  spaceship.pilot = newPilot;
}

const accelerate = (targetSpeed: number, spaceship: { name?: string; pilot?: string; speed: any; inMission?: boolean; }) => {
  spaceship.speed = targetSpeed;
}

const sendToMission = (spaceship: { name?: string; pilot?: string; speed?: number; inMission: any; }) => {
  spaceship.inMission = true;
}

const spaceship = {
  name: '',
  pilot: '',
  speed: 0,
  inMission: false,
}

const pilot = 'Matheus Fraga';

setPilot(pilot, spaceship);
accelerate(250, spaceship);
sendToMission(spaceship);