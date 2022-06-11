class Account {
    constructor(balanceC, balanceP, taxP) {
        this.balanceC = balanceC;
        this.balanceP = balanceP;
        this.taxP = taxP;
        console.log(`Corrente: ${this.balanceC}. Poupança: ${this.balanceP}, Juros da Poupança: ${this.taxP}%.`)
    }
    add(x, y) {
        if (x == 1) {
            this.balanceC += y;
            console.log(`Sua conta correnta agora é ${this.balanceC}.`)
        }
        else if (x == 2) {
            this.balanceP += y;
            console.log(`Sua conta poupança agora é ${this.balanceC}.`)
        }
        else if (x == 3) {
            this.balanceP -= (((this.taxP / 100) * y) + y);
            this.balanceC += y;
            console.log(`Você removeu da poupança ${y} reais restando em ${this.balanceP} com uma taxa de ${((this.taxP / 100) * y)} reais de juros. A conta corrente agora está em ${this.balanceC}`);
        }
    }

    remove(x, y) {
        if (x == 1) {
            this.balanceC -= y;
            console.log(`Sua conta correnta agora é ${this.balanceC} pois você retirou ${y} reais.`)
        }
        else if (x == 2) {
            this.balanceP -= y;
            console.log(`Sua conta poupança agora é ${this.balanceC} pois você retirou ${y} reais`)
        }
    }
}
class accountEx extends Account {
    constructor(balanceC, balanceP, taxP) {
        super(balanceC, balanceP, taxP * 2);
    }
}

let accountOne = new Account(500, 1000, 5);
accountOne.add(3, 100);
accountOne.remove(1, 200);


let accountTwo = new accountEx(10000, 20000, 10);
accountTwo.add(3, 1000);
