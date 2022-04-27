// function multiplicarNumero(x, y, z) {
//   return x * y * z;
// }

// console.log(multiplicarNumero(2, 4, 5));

// const result = multiplicarNumero(5, 5, 5);

// console.log(`Sue número é de ${result}`);

function podeDirigir(x, y) {
  if (x >= 18 && y == true) {
    console.log(
      `Como você tem ${x} anos e possui CNH (${y}), então pode dirigir`
    );
  } else {
    console.log(`Você não tem ${x} idade suficiente ou não possui (${y}) cnh`);
  }
}

podeDirigir(25, true);
podeDirigir(12, false);
podeDirigir(77, 0);
