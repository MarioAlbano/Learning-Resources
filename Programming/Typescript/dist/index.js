"use strict";
//Number exemplo
const myAge = 28;
console.log(myAge);
//String exemplo
const mySurname = "Albano";
let lastName = "Navas";
// lastName = 14; Esperado Erro
//Boolean exemplo
const isTrue = true;
let userInput = "";
userInput = 10;
userInput = "10";
//Array exemplo
let myArray = ["A", "B", "C", "D"];
console.log(myArray);
//Tupla exemplo
let tuplaTest;
tuplaTest = ["Teste de tupla", 200, true];
//Lista de tuplas exemplo
let tuplaListTest;
tuplaListTest = [];
tuplaListTest.push(["Tupla_01", 10]);
console.log(tuplaListTest);
tuplaListTest.push(["Tupla_01", 10]);
//Intersections exemplo
const interExample = 10;
const interExample2 = "10";
//Enum exemplo
var Direction;
(function (Direction) {
    Direction[Direction["cima"] = 0] = "cima";
    Direction[Direction["baixo"] = 1] = "baixo";
    Direction[Direction["esquerda"] = 2] = "esquerda";
    Direction[Direction["direita"] = 3] = "direita";
})(Direction || (Direction = {}));
const enumZero = Direction.cima;
console.log(enumZero);
const enumTres = Direction.direita;
console.log(enumTres);
//Type Assertions exemplo
let typeExample = "Teste de Type aqui";
let typeExample2 = typeExample.length;
console.log(typeExample2);
//Todo: Type Assertions, funções com string;void, object type, uso do ?, lista de objeto
