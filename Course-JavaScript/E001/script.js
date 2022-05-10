function Cachorro(raca, patas, cor) {
  this.raca = raca;
  this.patas = patas;
  this.cor = cor;
  //criando um método dentro do objeto
  this.uivar = function () {
    console.log("Auuuuu!");
  }
}

let husky = new Cachorro("Husky", 4, "Preto");

console.log(husky);
console.log(husky.uivar());