function checagemNumero(num) {
    //Transformando o objeto em number
    let number = Number(num);

    if (Number.isNaN(number)) {
        console.log("Por favor, passe somente números para o programa");
    } else {
        return number;
    }
}

checagemNumero(55);
checagemNumero("Alok");

let number = prompt("Digite um numero aqui");

checagemNumero(number);
