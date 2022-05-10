class Mamifero {
  constructor(patas) {
    this.patas = patas;
  }
}

let coiote = new Mamifero(6);

console.log(coiote.patas);

//Dizendo que cachorro é filho do mamifero
class Cachorro extends Mamifero {
  constructor(patas, raca) {
    super(patas, patas);
    this.raca = raca;
  }
  latir() {
    console.log("Au au");
  }
}

let pug = new Cachorro(4, "Pug");

console.log(pug.patas);
pug.latir();

console.log(new Cachorro instanceof Mamifero);

console.log(coiote instanceof Mamifero);