class Carrinho {
    constructor(itens, qtd, valorTotal) {
        this.itens = itens;
        this.qtd = qtd;
        this.valorTotal = valorTotal;
    }

    //método de adicionar item ao carrinho
    addItem(item) {

        let contador = 0;
        //criando um loop para acessar todos os itens do carrinho
        for (let itemCarrinho in this.itens) {
            //Está pesquisando entre os itens. Se o id for igual ao adicionado
            if (this.itens[itemCarrinho].id == item.id) {
                //se encontrar o mesmo ad, adiciona +1 ao item.qtd
                this.itens[itemCarrinho].qtd += item.qtd;
                contador = 1;
            }
        }

        if (contador === 0) {
            this, itens.push(item);
        }
        //atualizar o valor de quantidade dependendo do valor adicionado
        this.qtd += item.qtd;
        //atualizar os valores da compra dependendo do valor adicionado e a quantidade
        this.valorTotal += item.preco * item.qtd;
    }
}

//instanciando um objeto
let carrinho = new Carrinho([
    {
        id: 01,
        nome: "Camisa",
        qtd: 1,
        preco: 20
    },

    {
        id: 02,
        nome: "Calça",
        qtd: 2,
        preco: 50
    }
], 3, 120)

console.log(carrinho);

carrinho.addItem({ id: 01, nome: "Camisa", qtd: 2, preco: 20 });

console.log(carrinho);