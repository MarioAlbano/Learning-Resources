class Conta {
    constructor(saldo) {
        this.saldo = saldo;
    }

    deposito(valor) {
        this.saldo += valor;

    }

}

let contaJose = new Conta(0);

contaJose.deposito(10);

console.log(contaJose.saldo);