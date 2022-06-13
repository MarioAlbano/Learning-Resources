let promiseOne = Promise.resolve(5);

console.log("Outros códigos");

console.log(promiseOne);

promiseOne.then((valor) => { console.log(`O valor é ${valor}`) });

promiseOne.then((valor) => { console.log(`O valor com vezes 5 é ${valor * 5}`) });