"use strict"

//testando usar uma variável sem declara-la
let opa = "testando";

//Testando deletar uma função nativa do prototype
// delete Object.prototype;

function teste() {
    //Usando strict dentro de uma função
    "use strict"
    let testando = "Teste";
}

teste();

let objetoTeste = { p: 1, p: 2 };
console.log(objetoTeste);