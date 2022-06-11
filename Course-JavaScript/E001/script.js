class bank {
    constructor(balance) {
        this.balance = balance
        console.log(balance);
    }
    deposit(x) {
        this.balance += x;
        console.log(this.balance);
    }
    remove(x) {
        this.balance -= x;
        console.log(this.balance);
    }
}

let accountOne = new bank(400);

accountOne.balance;
accountOne.deposit(100);
accountOne.remove(300);