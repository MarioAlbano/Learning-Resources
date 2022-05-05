let numeroUm = 0;
let numeroDois = 0;
let resultado = 0;

let calculadora = {
  somar: function (numeroUm, numeroDois) {
    resultado = (numeroUm + numeroDois);
    console.log(resultado);
  },

  subtrair: function (numeroUm, numeroDois) {
    resultado = (numeroUm - numeroDois);
    console.log(resultado)
  },

  multiplicar: function (numeroUm, numeroDois) {
    resultado = (numeroUm * numeroDois);
    console.log(resultado)
  },

  dividir: function (numeroUm, numeroDois) {
    resultado = (numeroUm / numeroDois)
    console.log(resultado);
  },
}

calculadora.somar(3, 2);
calculadora.subtrair(3, 2);
calculadora.multiplicar(3, 2);
calculadora.dividir(3, 2);


