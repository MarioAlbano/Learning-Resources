class Cachorro {
  constructor(raca, patas, cor) {
    this.raca = raca;
    this.cor = cor;
  }
  latir() {
    console.log("Au au!");
  }
}
Cachorro.prototype.patas = 4;

let labrador = new Cachorro("Vira-Lata", "Amarelo");

labrador.latir();