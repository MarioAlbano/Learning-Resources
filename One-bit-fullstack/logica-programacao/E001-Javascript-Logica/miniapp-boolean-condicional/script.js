let dateLeave = prompt("Digite a data de saida (forma DD/MM/YYYY)");
dateLeave = moment(dateLeave, "DD/MM/YYYY");
let today = moment();
let differenceDate = (dateLeave - today);
let selectOption = prompt("1- Para segundos, 2- minutos, 3- horas, 4-dias");

function miniAppDate() {
    if (selectOption == 1) {
        let resultDate = Math.round(differenceDate / 1000);
        alert(`O tempo é de ${resultDate} segundos`);
        return true;
    } else if (selectOption == 2) {
        let resultDate = Math.round((differenceDate / 1000) / 60);
        alert(`O tempo é de ${resultDate} minutos`);
        return true;
    } else if (selectOption == 3) {
        let resultDate = Math.round((differenceDate / 1000) / 3600);
        alert(`O tempo é de ${resultDate} horas`);
        return true;
    } else if (selectOption == 4) {
        let resultDate = Math.round(((differenceDate / 1000) / 3600) / 24);
        alert(`O tempo é de ${resultDate} dias`);
        return true;
    } else if (selectOption > 4) {
        alert(`Infelizmente não foi possível identificar a opção. Tente novamente`);
    }
}

miniAppDate();