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

//JSON
const testObject3 = {
  nome: "Marco",
  sobrenome: "Reus",
  idade: 34,
  atributos: {
    valocidade: 95,
    chute: 90,
    passe: 90,
    drible: 93,
    defesa: 65,
    fisico: 83,
    time: "Borussia Dortmund",
  },
};

const jsonExample = JSON.stringify(testObject3); //Convertendo objeto para JSON
console.log(jsonExample);
const convertedJson = JSON.parse(jsonExample); //Convertendo JSON para objeto
console.log(convertedJson);

/*//Loop = for, usar o for para acessar um array, for of, forEach, while, forIn (menos usado)
 */

/*//Condicionais = if, if else, if else if else, == e ===, &&, ||, ternary operators, switch,
 */

/*//Truthy e Falsy = usar !! para saber se é true ou false. String vazia, 0, undefined, com false. Array vazio e objeto vazio como true. Charcar se uma lista é vazia. Booleando inversor !
 */

/*//Funções e Arrow functions = função padrão com 2 parâmetro, criar variável com resultado de uma função, fazer função passar valor para parêmtros caso não seja iniciada, arrow function, usar sem {} virando automaricamente um return
-Faz uma determinada ação
 */

/*//Javascript com programação orientada a objetos = usar classe com contructor, assinalar as variáveis criadas pelo constructor com o objeto que criamos, criar uma nova variável e instanciar com a keyword new, criar métodos dentro da classe com this e usar-los, método estático 'static metodo()', herdar heranças(usando super)
-Fazer um protótipo e imprimimos algo baseado no protótipo
*/

/*//Selecionar elementos do DOM = usar o getElementbyId, usar uma variável para o getelementbyid(referência ao elemento), usar o .innerText, usar o querySelector(retorna o elemento em si, e só retorna o primeiro elemento) , pegar um id e class ao mesmo tempo pelo querySelector, querySelectorAll, querySelectorAll especificando um filho de uma classe, usar getElementsByClassName(não conseguimos usar métodos de lista), getElementsByTagName
-Árvore cópia do html que é manipulável
 */

/*//Manipulando DOM = remover um li entre 3 li(firstElementChild.remove). Remover usando children e Remover o do meio (children[1]). usar lastElementChild, mudar style de um elemento
 */

/*//Eventos = usar o addEventListener, usar o preventDefault para evitar um submit, usar o target para pegar o valor do input, alterar o valor com .value. Fazer validação simples caso o campo esteja em branco, e se estiver preenchido trocar o fundo. Trocar os items pelo valor do nome e email
-Fazer uma ação quando algo acontecer
 */

/*validação de formulários = selecionar os campos com o queryselector, usar um addeventlistener e criar uma mensagem de erro caso o campo estiver vazio. Alterar uma class do css com .classList. Adicionar li num ul existente a cada input (createelement, classlist, textcontent). Usar o appendChild(). Dar um setTimeout depois de 3 segundos para limpar a mensagem de erro
 */
