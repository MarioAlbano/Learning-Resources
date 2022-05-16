class Carro {
    constructor(marca, cor, gasolinaRestante) {
        this.marca = marca;
        this.cor = cor;
        this.gasolinaRestante = gasolinaRestante;
    }
    dirigir(kmAndado) {
        this.gasolinaRestante -= kmAndado;
        if (this.gasolinaRestante <= 10) {
            console.log("Precisa reabastecer seu carro!");
        }
    }
    abastecer(kmReposto) {
        this.gasolinaRestante += kmReposto
    }
}

let saveiro = new Carro("Saveiro", "preta", 20);

console.log(saveiro);

saveiro.dirigir(10);

console.log(saveiro);

saveiro.abastecer(20);

console.log(saveiro);