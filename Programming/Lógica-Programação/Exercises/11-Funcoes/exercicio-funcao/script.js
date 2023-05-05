//Declaring Math Funcions
function triangleArea(base, height) {
  return ((base * height) / 2);
}

function rectangleArea(base, height) {
  return (base * height);
}

function squareArea(side) {
  return (side * side);
}

function trapezeArea(baseHighest, baseLowerest, height) {
  return ((baseHighest + baseLowerest) * (height / 2));
}

function circleArea(radius) {
  const pi = 3.14;
  return pi * (radius * radius);
}

//Starting loop program
alert("Bem vindo a Calculadora Geométrica!");
let userOption;
do {
  userOption = prompt(`Digite as seguintes opções:\n\n1 - Área do triângulo\n2 - Área do retângulo\n3 - Área do quadrado\n4 - Área do trapézio\n5 - Área do círculo\n6 - Sair`);

  switch (userOption) {
    case "1":
      const triangleBase = prompt("Qual a base do triângulo?");
      const triangleHeight = prompt("Qual a altura?");
      alert(`O resultado da área do triângulo é: ${triangleArea(triangleBase, triangleHeight)}`);
      break;
    case "2":
      const rectangleBase = prompt("Qual o tamanho da base?");
      const rectangleHeight = prompt("Qual o tamanho da altura?");
      alert(`O resultado da área do retângulo é: ${rectangleArea(rectangleBase, rectangleHeight)}`);
      break;
    case "3":
      const squareSide = prompt("Qual o tamanho do lado?");
      alert(`O resultado da área do quadrado é: ${squareArea(squareSide)}`);
      break;
    case "4":
      const trapezeBaseHighest = prompt("Qual o tamanho da base maior?");
      const trapezeBaseLowerest = prompt("Qual o tamanho da base menor?");
      const trapezeHeight = prompt("Qual a altura?");
      alert(`O resultado da área do trapézio é: ${trapezeArea(trapezeBaseHighest, trapezeBaseLowerest, trapezeHeight)}`);
      break;
    case "5":
      const circleRadius = prompt("Qual o tamanho do diâmetro?");
      alert(`O resultado da área do círculo é: ${circleArea(circleRadius)}`);
      break;
    case "6":
      alert("Saindo do programa. Obrigado pela visita!");
      break;
    default:
      alert("Opção inválida. Por favor tente novamente!");
  }
} while (userOption != 6)