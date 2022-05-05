let arrayUm = [1, 2, 3, 4, 5];
let resultado = 0;

function somarArray(x) {
  for (let i = 0; i < arrayUm.length; i++) {
    resultado += arrayUm[i];
    console.log(`A soma dos valores neste array valem ${resultado}`);
  }
}

somarArray(6);