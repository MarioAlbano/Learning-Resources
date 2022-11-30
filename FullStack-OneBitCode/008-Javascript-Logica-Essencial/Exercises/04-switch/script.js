/*
Values:
Milimetro (mm) *1000
Centímetro (cm) *100
Decímetro (dm) *10
Decâmetro (dam) /10
Hectômetro (hm) /100
Quilômetro (hm) /1000
*/

//Creating user values
const userValue = parseFloat(prompt("Digite um valor em metros"));
const userOption = parseFloat(prompt("Digite uma opção: \n1 - Milímetro\n2 - Centímetro\n3 - Decímetro\n4 - Decâmetro\n5 - Hectômetro\n6 - Quilômetro"));
let converterResult = 0;

//Starting switch case
switch (userOption) {
  case 1:
    converterResult = (userValue * 1000);
    alert(`O valor de ${userValue} Metros convertido em Milímetros é de ${converterResult}`)
    break;
  case 2:
    converterResult = (userValue * 100);
    alert(`O valor de ${userValue} Metros convertido em Centímetros é de ${converterResult}`)
    break;
  case 3:
    converterResult = (userValue * 10);
    alert(`O valor de ${userValue} Metros convertido em Decímetros é de ${converterResult}`)
    break;
  case 4:
    converterResult = (userValue / 10);
    alert(`O valor de ${userValue} Metros convertido em Decâmetros é de ${converterResult}`)
    break;
  case 5:
    converterResult = (userValue / 100);
    alert(`O valor de ${userValue} Metros convertido em Hectômetro é de ${converterResult}`)
    break;
  case 6:
    converterResult = (userValue / 1000);
    alert(`O valor de ${userValue} Metros convertido em Quilômetro é de ${converterResult}`)
    break;
  default:
    alert("Valor não identificado. Por favor tente novamente");
}