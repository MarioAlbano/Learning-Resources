class Cachorro {
  constructor(raca, patas, cor) {
    this.raca = raca;
    this.cor = cor;
  }
  latir() {
    console.log("Au au!");
  }
}

Cachorro.prototype.raca = "SRD";

let patas = Symbol();

Cachorro.prototype[patas] = 4

let labrador = new Cachorro("Vira-Lata", "Amarelo");

labrador.latir();

console.log(Cachorro.prototype[patas]);

console.log(labrador[patas]); 