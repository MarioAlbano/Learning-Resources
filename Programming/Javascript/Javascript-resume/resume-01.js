/*//Javascript
-Linguagem interpretada
-ECMAScript
-Navegador(cliente) e servidor(node)
-Padrão dos navegadores
-Frameworks
-Fullstack
-Mobile, Desktop

//Fundamentos
-Variáveis e tipos de dados
-Listas (arrays)
-Objetos
-JSON
-Loops(for, for of, while, forEach)
-Condicionais (if,else,switch, ternary)
-Funções e arrow functions
-Programação Orientada a Objetos
-Selecionar elementos do DOM
-Manipular elementos do DOM
-Eventos
-Criar e validar um formulário
 */

//Var,let,const
if (1 === 1) {
  var testScopeVar = 10;
}
console.log(testScopeVar); //Esperado sair do escopo

const constTest = "Olá"; //constTest = "Tchau!"; //console.log(constTest);

//Strings
let message = "Hello World!";
console.log(message.length);
let newMessage = "Aprendendo Javascript";
console.log(`${message} ${newMessage}`);
console.log(message.toUpperCase());

const testNames = "Mario,Albano,Pereira,Navas";
console.log(testNames.split(","));

//Numbers
const numberTest = 25;
console.log(numberTest / 2);
console.log(numberTest * 2);
console.log(numberTest + 105);
console.log(numberTest.toString() + 5);
console.log(typeof numberTest);

//Booleans
console.log(2 == 3);
console.log(2 == 2);

//Null e undefined
const nullTest = null; //Vazio porém variável iniciada
const undefinedTest = undefined; //Vazio e a variável não é iniciada

//Listas
const newListTest = [
  "Lewandowski",
  "Batshuayi",
  "Azpilicueta",
  "Eden Hazard",
  100,
  null,
];
console.log(newListTest[0]);
newListTest.push("Hyong-Ming-Son");
console.log(newListTest);
newListTest.unshift("Matuiti");
console.log(newListTest);
newListTest.shift();
console.log(newListTest);
newListTest.pop();
console.log(newListTest);
console.log(newListTest.indexOf(100));
newListTest[3] = null;
console.log(newListTest);
console.log(newListTest.indexOf(null));

console.log(newListTest);
newListTest.sort();
console.log(newListTest);
console.log(Array.isArray(newListTest));

//Map, filter e Reduce =
//Map: transforma cada item do array. Filter: Novo array que contém somente os elementos originais que satisfaçam alguma condição. Reduce: Quando você quer transformar todo o array em um número

const numbersTest = [0, 1, 2, 3, 4];
console.log(
  numbersTest.map((item) => {
    return item * 2;
  })
);

//Objetos = nome, sobrenome, idade. Acessar propriedades. Acessar propriedades específica de um array. Testar sem Destructuring e com Destructuring. Criar uma nova propriedade. Acessar objeto dentro de objeto. Destructuring com renomeação. Acessar propriedades do objeto dentro do array pai.

/*//JSON = converter objeto para json(JSON.stringify()), converter json para objeto(JSON.parse())
-Usado para transição de dados
*/

/*//Loop = for, usar o for para acessar um array, for of, forEach, while, forIn (menos usado)
 */

/*//Condicionais = if, if else, if else if else, == e ===, &&, ||, ternary operators, switch,
 */
