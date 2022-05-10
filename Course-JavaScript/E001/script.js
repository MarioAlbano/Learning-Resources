const cachorro = {
  raca: "vira-lata",
  uivar: function () {
    console.log("Auuuu");
  },
  latir: function () {
    console.log("au au");
  },
  morder: function () {
    console.log("Nhac!");
  },
  setRaca: function (raca) {
    this.raca = raca;
  },
  getRaca: function () {
    return "A raça é " + this.raca;
  }
}

console.log(cachorro.raca);
cachorro.setRaca("Pastore");
console.log(cachorro.raca);
console.log(cachorro.getRaca());
