let regexOne = new RegExp("amigos");

console.log(regexOne.test("Olá amigos, bem vindo a mais um video de: "));
console.log(regexOne.test("Hoje na segunda guerra mundial!"));

let regenxTwo = /guerra/;

console.log(regenxTwo.test("Hoje na segunda"));
console.log(regenxTwo.test("guerra mundial"));
console.log("Agora o segundo teste");
console.log(/teste/.test("teste"));