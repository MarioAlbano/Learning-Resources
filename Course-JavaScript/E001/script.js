class Conta {
    constructor(saldo) {
        this.saldo = saldo;
    }

    deposito(valor) {
        this.saldo += valor;
    }
}

let contaMaria = new Conta(1000);

contaMaria.deposito(5000);

console.log(contaMaria.saldo);