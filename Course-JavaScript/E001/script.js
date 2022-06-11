class Car {
    constructor(brand, color, gasAvailable) {
        this.brand = brand;
        this.color = color;
        this.gasAvailable = gasAvailable;
        console.log(`A marca é ${this.brand}, a cor é ${this.color} e tem ${this.gasAvailable} litros disponíveis no tanque.`);
    }
    distance(x) {
        this.gasAvailable -= (x / 11);
        if (this.gasAvailable <= 0) {
            console.log("Infelizmente acabou a sua gasolina!")
        } else {
            console.log(`Você tem ${this.gasAvailable} litros restante.`);
        }
    }

    refuel(x) {
        this.gasAvailable += x;
        console.log(`Você reabasteceu o seu carro e agora você tem ${this.gasAvailable} litros disponíveis`);
    }
}

let saveiro = new Car("Volkswagen", "Preta", 40);
saveiro.distance(0);
saveiro.refuel(20);
saveiro.distance(660);