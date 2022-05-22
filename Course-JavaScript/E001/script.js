class contaBancaria {
    constructor(saldoCorrente, saldoPoupanca, juros) {
        this.saldoCorrente = saldoCorrente;
        this.saldoPoupanca = saldoPoupanca;
        this.juros = juros;
    }

    deposito(valor) {
        this.saldoCorrente += valor;
    }

    saque(valor) {
        this.saldoCorrente -= valor;
    }

    transferenciaPoupanca(valor) {
        this.saldoCorrente -= valor;
        this.saldoPoupanca += valor;
    }

    transferenciaCorrente(valor) {
        this.saldoCorrente += valor;
        this.saldoPoupanca -= valor;
    }

    jurosAniversario(juros) {
        let jurosConta = (this.saldoPoupanca * this.juros) / 100;
        this.saldoPoupanca += jurosConta;
    }
}

class contaBancaria02 extends contaBancaria {
    constructor(saldoCorrente, saldoPoupanca, juros) {
        super(saldoCorrente, saldoPoupanca, juros * 2)

    }
}

let conta = new contaBancaria(1000, 2000, 1);
console.log(conta);

conta.saque(300);
console.log(conta);

conta.deposito(10000);
console.log(conta);

conta.transferenciaCorrente(2222);
console.log(conta);

conta.transferenciaPoupanca(1111);
console.log(conta);

conta.jurosAniversario();
console.log(conta);

let conta02 = new contaBancaria02(10000, 50000, 1);
console.log(conta02);

conta02.saque(3000);
console.log(conta02);

conta02.jurosAniversario();
console.log(conta02);

