let askDistance = prompt("Qual a distância?");
let askParameter = prompt("1- Parse \n 2- Unidade astronômica \n 3- Quilômetros");

let convertedValue;

switch (askParameter) {
    case "1":
        convertedValue = askDistance * 0.306601;
        alert(convertedValue);
        break;
    case "2":
        convertedValue = askDistance * 63241.1;
        alert(convertedValue);
        break
    case "3":
        convertedValue = askDistance * (9.5 * (Math.pow(10, 12)));
        alert(convertedValue);
        break
    default:
        askDistance = "Não encontrado a distância";
        askParameter = "Não encontrado a medida de conversão";
        break;
}