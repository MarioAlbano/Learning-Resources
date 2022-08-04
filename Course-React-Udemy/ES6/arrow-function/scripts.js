//Função normal

const soma = function (a, b) {
    return (
        a + b
    )
}
console.log(soma(5, 4));

//Função Arrow Function com somente uma linha
//Com arrow function é mais fácil chamar o This
const somaArrow = (a, b) => a + b;
console.log(somaArrow(5, 4));

const greetings = () => {
    let name = "Juan"

    if (name == "Juan") {
        console.log(`Olá ${name}, seja bem vindo!`);
    }
    else {
        console.log(`Infelizmente o usuário ${name} não foi encontrado. Tente novamente`);
    }
}

const myName = "Albano";
const arrowName = () => console.log(myName);
arrowName();

const iniciarTempo = () => {
    let testeTempo = "200";
    setTimeout(console.log(testeTempo), 2000);
}

iniciarTempo();