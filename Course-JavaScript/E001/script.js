let p = Promise.resolve(new Error("Não deu certo"));

console.log("Somente um teste");

p.then(value => console.log(value))
    .catch(reason => console.log("Fahou " + reason));