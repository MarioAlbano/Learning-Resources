function imc(peso, altura) {
    let imc = peso / (altura * altura);
    return imc;
}

console.log(imc(88, 1.75));