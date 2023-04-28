var setPilot = function (newPilot, spaceship) {
    spaceship.pilot = newPilot;
};
var accelerate = function (targetSpeed, spaceship) {
    spaceship.speed = targetSpeed;
};
var sendToMission = function (spaceship) {
    spaceship.inMission = true;
};
var spaceship = {
    name: '',
    pilot: '',
    speed: 0,
    inMission: false
};
var pilot = 'Matheus Fraga';
setPilot(pilot, spaceship);
accelerate(250, spaceship);
sendToMission(spaceship);
