//Primeira parte
function verificarValor(valor) {
    if (typeof valor === "boolean") {
        return "É um boolean!";
    } else {
        return "Não é boolean";
    }
}

console.log(verificarValor(12));
console.log(verificarValor(true));

//Segunda parte
function perimetroQuadrado(lado1, lado2, lado3, lado4) {
    let soma = (lado1 + lado2 + lado3 + lado4);
    return soma;
}
console.log(perimetroQuadrado(4, 4, 4, 4));

//Terceira parte
function nomeCompleto(nome, sobrenome) {
    return `Seu nome é ${nome} ${sobrenome}`;
}

console.log(nomeCompleto("Mario", "Albano"));

//Quarta parte
function verificaPar(num) {
    if (num % 2 === 0) {
        return "Seu número é par";
    } else {
        return "Não é par!";
    }
}

console.log(verificaPar(2));
console.log(verificaPar(3));
console.log(verificaPar(4));
console.log(verificaPar(5));

//Quinta parte
function tipoDado(dado) {
    return `Seu tipo de dado é ${typeof dado}`;
}

console.log(tipoDado("Alloha!"));
console.log(tipoDado(23));
console.log(tipoDado(true));

//Sexta parte
function eventoMouse() {
    let clique = document.addEventListener("scroll", function retornar() {
        console.log(nomeCompleto("Mario", "Albano"));
    })
}

eventoMouse();

//Sétima parte
// Corrija o erro abaixo
function precisoVisitar(paisesVisitados) {
    var totalPaises = 193;
    return `Ainda faltam ${totalPaises - paisesVisitados} países`
}

function jaVisitei(paisesVisitados) {
    var totalPaises = 193;
    return `Já visitei ${paisesVisitados} do total de ${totalPaises
        }`
}
console.log(precisoVisitar(20));
console.log(jaVisitei(20));

