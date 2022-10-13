let quadrado = {
    lados: 4,
    area(lado) {
        return lado * lado;
    },
    perimetro(lado) {
        return this.lados * lado;
    },
    cincoThis() {
        return 5 * this.lados;
    }
}

console.log(quadrado.area(4));
console.log(quadrado.perimetro(4));
console.log(quadrado.cincoThis());