// let novoElemento = document.createElement("p");
// let texto = document.createTextNode("Algum texto");

// novoElemento.appendChild(texto);

// let elementoAlvo = document.querySelector("#titulo-principal");
// let elementoPai = document.querySelector("#container-principal");

// elementoPai.insertBefore(novoElemento, elementoAlvo);

let novoElemento = document.createElement("p");
let elementoAlvo = document.querySelector("#titulo-principal");
let elementoPai = document.querySelector("#container-principal");

elementoPai.insertBefore(novoElemento, elementoAlvo);

let texto = document.createTextNode("Texto criado pelo DOM");
novoElemento.appendChild(texto);
