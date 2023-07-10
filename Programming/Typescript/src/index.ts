//Number exemplo
const myAge: number = 28;
console.log(myAge);

//String exemplo
const mySurname: string = "Albano";
let lastName = "Navas";
// lastName = 14; Esperado Erro

//Boolean exemplo
const isTrue: boolean = true;
let userInput: any = "";
userInput = 10;
userInput = "10";

//Array exemplo
let myArray: string[] = ["A", "B", "C", "D"];
console.log(myArray);

//Tupla exemplo
let tuplaTest: [string, number, boolean];
tuplaTest = ["Teste de tupla", 200, true];

//Lista de tuplas exemplo
let tuplaListTest: [string, number][];
tuplaListTest = [];
tuplaListTest.push(["Tupla_01", 10]);
console.log(tuplaListTest);
tuplaListTest.push(["Tupla_01", 10]);

//Intersections exemplo
const interExample: string | number = 10;
const interExample2: string | number = "10";

//Enum exemplo
enum Direction {
  cima,
  baixo,
  esquerda,
  direita,
}

const enumZero: Direction = Direction.cima;
console.log(enumZero);
const enumTres: Direction = Direction.direita;
console.log(enumTres);

//Type Assertions exemplo
let typeExample: any = "Teste de Type aqui";
let typeExample2: number = (typeExample as string).length;
console.log(typeExample2);

//Função com String exemplo
function processName(name: string): void {
  console.log(name);
}
processName("Joseph");

//Object type exemplo
interface Pessoa1 {
  nome: string;
  idade: number;
  email: string;
  adicional?: string;
}

const Albano: Pessoa1 = {
  nome: "Mario",
  idade: 28,
  email: "mariom@gmail.com",
};

console.log(Albano);

const Albano2: Pessoa1 = {
  nome: "Mario",
  idade: 28,
  email: "mariom@gmail.com",
  adicional: "Exemplo de '?' em typescript",
};

console.log(Albano2);

//Arrow function exemplo
const sumNumbers = (a: number, b: number): number => {
  return a * b;
};
console.log(sumNumbers(2, 2));

//Type exemplo
type Stats = {
  pace: number;
  stamina: number;
};

type myselfPerson = {
  myName: string;
  myAge: number;
  myWeight?: number;
  listStatus?: Stats[];
};

//Instanciando o Type
const Edgar: myselfPerson = {
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
const printName = (nameWillPrint: number) => {
  console.log(nameWillPrint);
};
printName(Edgar.myWeight!);

//Intersection exemplo
type Academic = {
  course: string;
};

const Student: myselfPerson & Academic = {
  myName: "Mario",
  myAge: 28,
  course: "Full Stack",
};
console.log(Student);

//Unions exemplo
const FuncaoUnion = (data: string | number) => {
  console.log(data);
};
FuncaoUnion(10);
FuncaoUnion("Um texto aqui");

//Interfaces exemplo Obs: type mais flexível e pode ter combinações. Interface descreve objeto, adequado para propriedades e métodos

//Todo: interfaces(readonly, reestringir funções, criar funções no type, classes com typescript, métodos, implements, protected), generics, promises com generics, classes com generics
