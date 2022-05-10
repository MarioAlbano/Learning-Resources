function criarCachorro(raca, patas, cor) {
  let cachorro = Object.create({});
  cachorro.raca = raca;
  cachorro.patas = patas;
  cachorro.cor = cor;
  cachorro.latir = function () {
    console.log("Au au");
  }
  return cachorro;
}

let doberman = criarCachorro("Doberman", 4, "Preto");

console.log(doberman);
doberman.latir();