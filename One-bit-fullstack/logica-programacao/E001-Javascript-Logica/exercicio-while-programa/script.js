function program() {
    let nameShip = prompt("Qual o nome da nave?");
    let askDirection = prompt("Deseja entrar na dobra espacial? 1 - Sim | 2 - Não");
    let countDirection = 0;
    while (askDirection == 1) {
        askDirection = prompt("Deseja entrar na dobra espacial?");
        countDirection += 1;
    }
    alert(`O nome da nave é ${nameShip} e o número de dobras foi de: ${countDirection}`)
}

program();