// let novoElemento = document.createElement("p");
// let texto = document.createTextNode("Algum texto");

// novoElemento.appendChild(texto);

// let heading = document.querySelector('#titulo-principal');
// let paiHeading = heading.parentNode;

// paiHeading.replaceChild(novoElemento, heading);

let novoElemento = document.createElement("p");
let elementoAlvo = document.querySelector("#titulo-principal");
let texto = document.createTextNode("Um texto inserido através do 'document.createTextNode'");

novoElemento.appendChild(texto);

let elementoPai = document.querySelector("#container-principal");
elementoPai.insertBefore(novoElemento, elementoAlvo);
