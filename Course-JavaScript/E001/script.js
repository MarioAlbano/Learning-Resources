class contaBancaria {
    constructor(saldoCorrente, saldoPoupanca, juros) {
        this.saldoCorrente = saldoCorrente;
        this.saldoPoupanca = saldoPoupanca;
        this.juros = juros;
    }
    depositoCorrente(valor) {
        this.saldoCorrente += valor;
    }
    depositoPoupanca(valor) {
        valor *= 1 - 0.05;
        this.saldoPoupanca += valor;
    }
    saqueCorrente(valor) {
        this.saldoCorrente -= valor;
    }
    saquePoupanca(valor) {
        this.saldoPoupanca -= valor;
    }

    transferenciaPoupancaCorrente(valor) {
        this.saldoPoupanca -= valor;
        this.saldoCorrente += valor;
    }
}

let contaJoao = new contaBancaria(1000, 1000, 5);
console.log(contaJoao);

contaJoao.depositoCorrente(200);
console.log(contaJoao);

contaJoao.depositoPoupanca(55);
console.log(contaJoao);

contaJoao.saqueCorrente(555);
console.log(contaJoao);

contaJoao.saquePoupanca(18);
console.log(contaJoao);

contaJoao.transferenciaPoupancaCorrente(200);
console.log(contaJoao);