class pessoa {
  constructor(nome) {
    this.nome = nome;
  }

  dizerNome() {
    console.log(`Meu nome é ${this.nome}`);
  }
}

module.exports = pessoa;
