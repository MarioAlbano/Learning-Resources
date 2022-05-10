class Cachorro {
  constructor(raca, patas, cor) {
    this.raca = raca;
    this.cor = cor;
  }
  latir() {
    console.log("Au au!");
  }

  get getCor() {
    return this.cor;
  }

  set setCor(cor) {
    this.cor = cor;
  }
}

let pastor = new Cachorro("Pastor alemão", 4, "preto e amarelo");

console.log(pastor);

pastor.setCor = "Blue";
console.log(pastor.getCor);

console.log(pastor);