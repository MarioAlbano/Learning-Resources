function Cachorro(raca, patas, cor) {
  this.raca = raca;
  this.patas = patas;
  this.cor = cor;
}

Cachorro.prototype.uivar = function () {
  console.log("Auuuu");
}

Cachorro.prototype.latir =
  function () {
    console.log("Au Au!");
  }

let husky = new Cachorro("Husky", 4, "Preto");

console.log(husky);
console.log(husky.uivar());
console.log(husky.latir());