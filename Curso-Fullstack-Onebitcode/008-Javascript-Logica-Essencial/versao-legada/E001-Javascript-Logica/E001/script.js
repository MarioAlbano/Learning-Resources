let askShipName = prompt("Qual o nome da nave?");
let newShipName = "";
for (i = askShipName.length - 1; i >= 0; i--) {
    if (askShipName[i] == "e") { break }
    else {
        newShipName += askShipName[i];
    }
}

alert(`Nome original: ${askShipName}. Nome novo: ${newShipName}`);