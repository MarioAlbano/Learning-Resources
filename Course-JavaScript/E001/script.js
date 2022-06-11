class shoppingCart {
    constructor(itens, amount, total) {
        this.itens = itens;
        this.amount = amount;
        this.total = total;
    }
    add(x, y) {
        this.itens += x;
        this.amount += y;
        this.total += (x * y);
        console.log(`Você tem ${this.itens} items, com a quantidade de ${this.amount}, totalizando em R$: ${this.total},00`)
    }
    remove(x, y) {
        this.itens -= x;
        this.amount -= y;
        this.total -= (x * y);
        console.log(`Você tem ${this.itens} items, com a quantidade de ${this.amount}, totalizando em R$: ${this.total},00`)
    }
}

let cartOne = new shoppingCart(0, 0, 0);

cartOne.add(1, 3);
cartOne.remove(1, 3);
cartOne.add(5, 50);