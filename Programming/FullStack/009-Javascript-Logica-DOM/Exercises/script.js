function createPElement() {
  let divElement = document.querySelector("#createP");
  let pElement = document.createElement("p");
  pElement.innerText = prompt("Qual o texto que deseja adicionar?");
  divElement.appendChild(pElement);
}
