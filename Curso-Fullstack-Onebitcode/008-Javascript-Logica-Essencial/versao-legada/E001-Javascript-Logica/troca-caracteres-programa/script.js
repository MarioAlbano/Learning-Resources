let nameShip = prompt("Qual o nome da sua nave?");
let askStringOut = prompt("Qual caracter você deseja retirar?");
let askStringIn = prompt("Por qual letra deseja inserir")
let newNameShip = "";
for (i = 0; i < nameShip.length; i++) {
    if (nameShip[i] == askStringOut) {
        newNameShip += askStringIn;
    } else {
        newNameShip += nameShip[i];
    }
}
alert(`O antigo nome da sua nave era ${nameShip} e agora é ${newNameShip
    }`);