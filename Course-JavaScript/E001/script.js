const cachorro = {
  patas: 4,
  raca: "desconhecido",
  latir: function () {
    console.log("Au!");
  }
}

let labrador = Object.create(cachorro);

labrador.latir();

labrador.raca = "labrador";
console.log(labrador.raca);
console.log(cachorro.raca);


let pastor = Object.create(cachorro);
pastor.raca = "Pastor Alemão";

console.log(pastor.raca);