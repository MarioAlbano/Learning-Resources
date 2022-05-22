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
        this.saldoPoupanca -= valor;
    }
}

let conta = new contaBancaria(1000, 2000, 1);
console.log(conta);

conta.saque(300);
console.log(conta);

conta.deposito(10000);
console.log(conta);
