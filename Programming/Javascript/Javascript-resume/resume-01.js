/*//Javascript
-Linguagem interpretada
-ECMAScript
-Navegador(cliente) e servidor(node)
-Padrão dos navegadores
-Frameworks
-Fullstack
-Mobile, Desktop

//Fundamentos do javascript
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
console.log(testScopeVar); //Esperado que a variável var saia do escopo

const constTest = "Olá"; //constTest = "Tchau!"; //console.log(constTest);

//Strings
let message = "Hello World!";
console.log(message.length); //Verificando tamanho da string
let newMessage = "Aprendendo Javascript";
console.log(`${message} ${newMessage}`); //Concatenando string com template literals
console.log(message.toUpperCase()); //Usando métodos na string para caixa alta

const testNames = "Mario,Albano,Pereira,Navas";
console.log(testNames.split(",")); //Usando método de dividir string separando por vírgula

//Numbers
const numberTest = 25; //Exemplo de número e manipulações com números
console.log(numberTest / 2);
console.log(numberTest * 2);
console.log(numberTest + 105);
console.log(numberTest.toString() + 5);
console.log(typeof numberTest);

//Booleans
console.log(2 == 3); //Ou true ou False
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
]; //Exemplo de Array

console.log(newListTest[0]); //Verifica item 0 do array
newListTest.push("Hyong-Ming-Son"); //Adicionando no final do array
console.log(newListTest);
newListTest.unshift("Matuiti"); //Adicionando no começo do array
console.log(newListTest);
newListTest.shift(); //Remove o primeiro item do array
console.log(newListTest);
newListTest.pop(); //Remove o último item do array
console.log(newListTest);
console.log(newListTest.indexOf(100)); //Achando o index de algum elemento, no caso o número 100
newListTest[3] = null; //Redefininfo algum item especídico do array
console.log(newListTest);
console.log(newListTest.indexOf(null));

console.log(newListTest);
newListTest.sort(); //Organiza o array
console.log(newListTest);
console.log(Array.isArray(newListTest)); //Verifica se é um array ou não

//Map, filter e Reduce
//Resumo = Map: transforma cada item do array. Filter: Novo array que contém somente os elementos originais que satisfaçam alguma condição. Reduce: Quando você quer transformar todo o array em um número
const numbersTest = [0, 1, 2, 3, 4];
console.log(
  numbersTest.map((item) => {
    return item * 2; //Mapeia e retorna cada número * 2
  })
);

console.log(
  numbersTest.filter((item) => {
    return item % 2 == 0; //Filtra todos os números pares
  })
);

console.log(
  numbersTest.reduce((acumulador, valorAtual) => {
    return acumulador + valorAtual;
  }, 5) //Soma todos os números, começando com 5
);

//Objetos
const testObject = { nome: "Mario", sobrenome: "Albano", idade: 27 }; //Exemplo objeto
console.log(testObject.nome);
console.log(testObject.idade);

const testObject2 = {
  //Exemplo objecto com array e objeto dentro
  nome: "Eduardo",
  sobrenome: "Marques",
  idade: 40,
  cursos: ["Javascript", "Typescript", "React"],
  idiomas: { nativo: "Português", avancado: "Inglês" },
};

console.log(testObject2.cursos[1]); //Acessando um array dentro do objeto

let nome = testObject2.nome; //Sem destructuring
console.log(nome);

let { idade } = testObject2; //Com destructuring
console.log(idade);

testObject2.atributoAdicional = "Atributo criado"; //Criando nova propriedade
console.log(testObject2);

console.log(testObject2.idiomas); //Acessando objeto dentro do objeto

/*//JSON = converter objeto para json(JSON.stringify()), converter json para objeto(JSON.parse())
-Usado para transição de dados
*/

/*//Loop = for, usar o for para acessar um array, for of, forEach, while, forIn (menos usado)
 */

/*//Condicionais = if, if else, if else if else, == e ===, &&, ||, ternary operators, switch,
 */
