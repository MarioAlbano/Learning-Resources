//setInterval is infinite and we can create clearInterval(variableName) to stop. setTimeOut it´s only one attempt

function randomInterval() {
  document.write("<br> Um intervalo está sendo chamado");
}

let threeSeconds = setInterval(randomInterval, 3000);
clearInterval(threeSeconds);

// setTimeout(randomInterval, 1000);

//webStorage save info after the user close the browser. local and session
