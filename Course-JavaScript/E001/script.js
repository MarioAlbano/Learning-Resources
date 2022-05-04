let arrayUm = [1, 2, 3, 4, 5, 6, 8, 9, 0];
let arrayDois = [1, 2, 3];
let arrayTres = [1, 2, 3, 4, 5];

function quantidadeArray(x) {
  if (x.length > 5) {
    console.log("Muitos arrays");
  }
  else if (x.length == 5) {
    console.log("Número certo de arrays!");
  }
  else {
    console.log("Poucos arrays");
  }
}

quantidadeArray(arrayUm);
quantidadeArray(arrayDois);
quantidadeArray(arrayTres);