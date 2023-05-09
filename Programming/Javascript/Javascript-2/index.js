/*//O que é o javascript
-Linguagem de programação interpretada, ou seja, lido e executado
-Evolui conforme a especificação ECMAScript
-É executada no navegador(cliente) e também no servidor (Node)

//Por que aprender Javascript?
-É a linguagem de programação padrão de todos os navegadores
-Frameworks poderosos como React utilizam Javascript
-Usado para desenvolver aplicações full stack
-Usado para desenvolver mobile
-Usado em aplicações desktop

//Conteúdo
-Variáveis e tipos de dados
-Listas (arrays)
-Objetos
-JSON
-Loops (for, for of, while, forEach)
-Funções e Arrow Functions
-Programação Orientada a Objetos
-Selecionar elementos do DOM
-Manipular elementos do DOM
-Eventos
-Criar e validar um formulário

//Usando o Javascript
-Utilizar a tag script com src antes do body

//Variáveis e tipos de dados
-var (sai do escopo exemplo função)
-const (constante não alterável)
-let
 */

if (1 == 1) {
  var resultadoVar = 10;
}
console.log(resultadoVar); //Esperado 10 no console

const resultadoConst = 20;
// resultadoConst = 10; Erro!

let resultadoLet = 20;
resultadoLet = 10;

//String e manipulações com a string
let resultadoString = "Bem vindo ao Javascript";
console.log(resultadoString.length);

//Template literals
let resultadoString2 = `Texto: ${resultadoString}`;
console.log(resultadoString2);

//toUpperCase e toLowerCase
console.log(resultadoString2.toUpperCase());
console.log(resultadoString2.toLowerCase());

//Método split
let splitExemplo = "Maria,João,José";
console.log(splitExemplo.split(","));

//Numbers
const numberExemplo = 5;
console.log(numberExemplo + 10);
console.log(numberExemplo / 2);
console.log(numberExemplo.toString());
console.log(typeof numberExemplo);

//Booleanos
let booleanoExemplo = 1 == 1;
console.log(booleanoExemplo);

let booleanoExemplo2 = 11 == 22;
console.log(booleanoExemplo2);

//null e undefined
const nullExemplo = null; //Variável iniciada porém vazia
const undefinedExemplo = undefined; //Váriavel que não existe

//Listas
const namesLista = ["Felipe", "Ronaldo", "Vagner", 10, false];
console.log(namesLista[0]);
console.log(namesLista[2]);

//Método push
namesLista.push("Antônio"); //Adiciona como último elemento
console.log(namesLista);

namesLista.pop(); //Remove como último elemento
console.log(namesLista);

namesLista.shift(); //Remove o primeiro elemento
console.log(namesLista);

namesLista.unshift("Batshuayi"); //Adiciona como primeiro elemento
console.log(namesLista);

namesLista[0] = "Reus";
console.log(namesLista); //Renomeia um item da lista

console.log(namesLista.indexOf("Vagner")); //Mostra o índice que está um elemento

const namesListaSort = namesLista.sort();
console.log(namesListaSort);

console.log(namesLista.length); //Verifica o tamanho do array

console.log(Array.isArray(namesLista)); //Verifica se é um array, no caso true
console.log(Array.isArray(resultadoLet)); //Verifica se é um array, no caso false

//Usando o map
const arrayExemplo3 = [1, 2, 3, 4, 5];
const arrayComMap = arrayExemplo3.map((number) => {
  return number * 2;
});
console.log(arrayComMap);

//Usando o filter
const idadeArray = [8, 13, 27, 30, 22, 40];
console.log(
  idadeArray.filter((age) => {
    return age % 2 === 0;
  })
);

//Usando o reduce
const idadeArray2 = [8, 13, 27, 30, 22, 40];
console.log(
  idadeArray2.reduce((acumulador, idade) => {
    return acumulador + idade;
  }, 0)
); //idade seria o elemento a percorrer, acumulador serio o 0 que foi passado
Teste;
