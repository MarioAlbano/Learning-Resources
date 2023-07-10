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
//Função com String exemplo
function processName(name) {
    console.log(name);
}
processName("Joseph");
const Albano = {
    nome: "Mario",
    idade: 28,
    email: "mariom@gmail.com",
};
console.log(Albano);
const Albano2 = {
    nome: "Mario",
    idade: 28,
    email: "mariom@gmail.com",
    adicional: "Exemplo de '?' em typescript",
};
console.log(Albano2);
//Arrow function exemplo
const sumNumbers = (a, b) => {
    return a * b;
};
console.log(sumNumbers(2, 2));
//Instanciando o Type
const Edgar = {
    myName: "Edgar",
    myAge: 40,
    listStatus: [
        {
            pace: 60,
            stamina: 50,
        },
        {
            pace: 70,
            stamina: 150,
        },
        {
            pace: 95,
            stamina: 100,
        },
    ],
};
console.log(Edgar);
//Exemplo com ! para mostrar que algo existe
const printName = (nameWillPrint) => {
    console.log(nameWillPrint);
};
printName(Edgar.myWeight);
const Student = {
    myName: "Mario",
    myAge: 28,
    course: "Full Stack",
};
console.log(Student);
//Unions exemplo
const FuncaoUnion = (data) => {
    console.log(data);
};
FuncaoUnion(10);
FuncaoUnion("Um texto aqui");
//Todo: Unions, interfaces(readonly, intersection, reestringir funções, criar funções no type, classes com typescript, métodos, implements, protected), generics, promises com generics, classes com generics
