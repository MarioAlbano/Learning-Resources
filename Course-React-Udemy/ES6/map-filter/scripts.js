const novoArray = [1, 2, 3, 4, 5, 6, 7, 8, 9];

//Filter filtra os elementos de um array
const altoNumero = novoArray.filter((n) => {
    if (n >= 4) {
        return (n);
    }
})

console.log(altoNumero);

objetoDisponivel = { um: true, dois: false, tres: true, quatro: false };

//Object.values auxilia a função entender o objeto
const teste = Object.values(objetoDisponivel).filter((n) => {
    if (n == true) {
        return n
    }
});

console.log(teste);