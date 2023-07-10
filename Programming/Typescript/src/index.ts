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
  register?(): string;
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
  register() {
    return "Deu certo!";
  },
};

console.log(Edgar);
console.log(Edgar.register?.());

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

//Interfaces exemplo Obs: type mais flexível e pode como blueprint ter combinações de tipos. Interface descreve objeto, adequado para propriedades e métodos
interface MathCalcs {
  (x: number, y: number): number;
}

const sumNumbers2: MathCalcs = (x, y) => {
  return x + y;
};

const subtractionNumber2: MathCalcs = (x, y) => {
  return x - y;
};
console.log(sumNumbers2(5, 5));
console.log(subtractionNumber2(15, 25));

//Classe exemplo
class PersonC {
  //Protected are accessible within the defining class and its subclasses .Private are accessible only within the defining class.

  constructor(name: string, protected age: number) {}
  GreetSomeone(): void {
    console.log("Olá");
  }
}
const Albano3 = new PersonC("Albano", 18);
console.log(Albano3);

//readyonly exemplo
interface AnotherPerson {
  readonly name: string;
  age: Number;
}

const Reus: AnotherPerson = {
  name: "Marco Reus",
  age: 30,
};
console.log(Reus);
// Reus.name = "Lukaku"; Esperado um erro

//Generics exemplo
interface printUsuario<T> {
  name: string;
  age: number;
  data: T;
}

const Azpilicueta: printUsuario<string> = {
  name: "Azpilicueta",
  age: 32,
  data: "Chelsea",
};
const Hazard: printUsuario<number> = {
  name: "Hazard",
  age: 28,
  data: 11,
};
console.log(Azpilicueta);
console.log(Hazard);

//Todo: promises com generics, classes com generics
