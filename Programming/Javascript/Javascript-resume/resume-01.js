/*//****************Javascript****************
-Linguagem interpretada
-ECMAScript
-Navegador(cliente) e servidor(node)
-Padrão dos navegadores
-Frameworks
-Fullstack
-Mobile, Desktop

//****************Fundamentos do javascript****************
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

//****************Var,let,const****************
if (1 === 1) {
  var testScopeVar = 10;
}
console.log(testScopeVar); //Esperado que a variável var saia do escopo

const constTest = "Olá"; //constTest = "Tchau!"; //console.log(constTest);

//****************Strings****************
let message = "Hello World!";
console.log(message.length); //Verificando tamanho da string
let newMessage = "Aprendendo Javascript";
console.log(`${message} ${newMessage}`); //Concatenando string com template literals
console.log(message.toUpperCase()); //Usando métodos na string para caixa alta

const testNames = "Mario,Albano,Pereira,Navas";
console.log(testNames.split(",")); //Usando método de dividir string separando por vírgula

//****************Numbers****************
const numberTest = 25; //Exemplo de número e manipulações com números
console.log(numberTest / 2);
console.log(numberTest * 2);
console.log(numberTest + 105);
console.log(numberTest.toString() + 5);
console.log(typeof numberTest);

//****************Booleans****************
console.log(2 == 3); //Ou true ou False
console.log(2 == 2);

//****************Null e undefined****************
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

//****************Map, filter e Reduce****************
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

//****************Objetos****************
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

//****************JSON****************
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

//*****************Loop****************
console.log(Object.keys(testObject3.atributos).length); //Acessando o tamanho de um objeto

for (let i = 0; i < testObject2.cursos.length; i++) {
  console.log(testObject2.cursos[i]);
} //Exemplo for em arrays

for (let value of Object.values(testObject3.atributos)) {
  console.log(value);
} //Exemplo for of em objetos

for (let value of testObject2.cursos) {
  console.log(value);
} //Exemplo for of em Arrays

let whileExampleTest = 0;
while (whileExampleTest <= 10) {
  console.log(whileExampleTest);
  whileExampleTest++;
} //Exemplo while

Object.keys(testObject3.atributos).forEach((element) => {
  console.log(element);
}); //Exemplo forEach com objetos

testObject2.cursos.forEach((curso) => {
  console.log(curso);
}); //Exemplo forEach com array

//*****************Condicionais*****************
const ifExampleTest = 10;
const ifExampleTest2 = 20;

if (ifExampleTest === 10 && typeof ifExampleTest == "number") {
  console.log("Teste de if");
} else if (ifExampleTest2 == 20) {
  console.log("Teste de if2");
} else {
  console.log("Erro no if");
} //Exemplo if else, else if, ==, === e &&

if (ifExampleTest === 100 || typeof ifExampleTest == "number") {
  console.log("Teste de if");
} else if (ifExampleTest2 == 20) {
  console.log("Teste de if2");
} else {
  console.log("Erro no if");
}

const ternaryExample = 20;
console.log(ternaryExample > 18 ? "Maior de idade" : "Menor de idade"); //Examplo de operador ternário

const switchTest = 3;
switch (switchTest) {
  case 0:
    console.log("Número é o zero");
    break;
  case 1:
    console.log("Número é o um");
    break;
  case 2:
    console.log("Número é o dois");
    break;
  case 3:
    console.log("Número é o três");
    break;
  default:
    console.log("Não identificado nenhum número");
} //Exemplo de Switch case

//*****************Truthy e Falsy*****************
const truthyExample = []; //Exemplo de valor verdadeiro
const truthyExample2 = {}; //Exemplo de valor verdadeiro
const falsyExample = null; //Exemplo de valor falso
const falsyExample2 = 0; //Exemplo de valor falso
const falsyExample3 = undefined; //Exemplo de valor falso
const falsyExample4 = false; //Exemplo de valor falso
const falsyExample5 = ""; //Exemplo de valor falso
const reversorValor = !true; //Exemplo do operador reversor !
console.log(!!truthyExample);
console.log(!!truthyExample2);
console.log(!!falsyExample);
console.log(!!falsyExample2);
console.log(!!falsyExample2);
console.log(!!falsyExample4);
console.log(reversorValor);

const verificarVazio = [];
console.log(
  `Verificador de array fazio: ${
    verificarVazio.length > 0 ? "Array cheio" : "Array vazio"
  }`
); //Exemplo para verificar se o array é vazio

//*****************Funções e Arrow functions*****************
function funcaoExemplo(x, y = 10) {
  return x * 5 + y;
} //Exemplo função simples

console.log(funcaoExemplo(15)); //Chamando a função

const resultadoFuncaoExemplo = funcaoExemplo(15); //Atribuindo o valor da função a uma variável. Precisa do return na função para isto funcionar
console.log(resultadoFuncaoExemplo);

const arrowFunctionExampe = (x, y = 10) => {
  return x * 5 - y;
}; //Exemplo arrow function
console.log(arrowFunctionExampe(15));

const arrowFunctionExampe2 = (x) => x; //Exemplo de arrow function sem o {}. Ele entende automaticamente que há um return
console.log(arrowFunctionExampe2(100));

//*****************Javascript com programação orientada a objetos*****************
class pessoaExemplo {
  constructor(nome, idade) {
    this.nome = nome;
    this.idade = idade;
  } //Criada a classe, definido os parâmetro e usando o this para acessá-los

  falar() {
    console.log(`Olá! Meu nome é ${this.nome} e eu tenho ${this.idade} anos.`);
  } //Criado um método. Podemos acessar as propriedades da nossa classe com o this

  static andar20passos() {
    console.log(`Você andou ${20} passos!`);
  } //Exemplo de método estático. Não pode ser acessado diretamente por outras classes
}

pessoaExemplo.andar20passos(); //Exemplo usando método estático não acessível para objetos instanciados

const pessoaExemplo1 = new pessoaExemplo("Edgar", 34); //Instanciando de uma classe
pessoaExemplo1.falar(); //Usando o método da classe original pelo objeto criado

pessoaExemplo1.criandoNovoMetodo = (curso) => {
  console.log(`Eu sou ${this.nome}. Agora eu estou estudando ${curso}.`);
}; //Criando um novo método do objeto instanciado. Com arrow function não conseguimos usar o this
pessoaExemplo1.criandoNovoMetodo("Java");

pessoaExemplo1.criandoNovoMetodo2 = function (curso) {
  console.log(`Eu sou ${this.nome}. Agora eu estou estudando ${curso}.`);
}; //Criando um novo método do objeto instanciado
pessoaExemplo1.criandoNovoMetodo2("PHP");

class Estudante extends pessoaExemplo {
  constructor(nome, idade, universidade, presencial) {
    super(nome, idade);
    this.universidade = universidade;
    this.presencial = presencial;
  }
  cursarMateria(materia) {
    console.log(
      `Sou o ${this.nome} com a idade de ${
        this.idade
      }. Estou cursando a disciplina de ${materia} ${
        this.presencial ? "presencialmente no campus" : "a distância"
      }`
    );
  }
} //Exemplo de herdar herança com o super. 'Estudante' herda características de 'Pessoa' e reaproveita estruturas pré-definidas

const exemploAluno = new Estudante("Mario", 27, "Puc", false);
console.log(exemploAluno);
exemploAluno.cursarMateria("SQL"); //Objeto criado a partir de uma classe com herança de uma outra classe

//***************Document Object Model***************
const tituloPagina = document.getElementById("titulo-form");
tituloPagina.innerText = "Formulário D.O.M.";

const subtituloPagina = document.querySelector(".subtitulo-form");
subtituloPagina.innerHTML = "Teste de dom com formulários";

const doisForms = document.querySelectorAll(".label-nome, .label-email");
doisForms.forEach((input) => {
  input.style.color = "blue";
}); //Utilizando dois valores no querySelectorAll

const tagExemplo = document.getElementsByTagName("h6");
Array.from(tagExemplo).forEach((inputSelecionado) => {
  inputSelecionado.innerText = "Texto criado com getElementsByTagName";
}); //Selecionado a tag h6, converter objetos de array para objetos iterável, alterado texto interno

const alterandoPrimeiroFilho = document.querySelector(
  "#div-teste-form :first-child"
);
alterandoPrimeiroFilho.innerText = "Texto gerado pelo pai";

const alterandoPelaClasse = document.getElementsByClassName("h5-teste-form");
for (let i = 0; i < alterandoPelaClasse.length; i++) {
  const elemento = alterandoPelaClasse[i];
  elemento.style.color = "blue";
} //Alterando com o getElementsByClassName. Como não é um array iterável, usamos o for para iterar e mudar

//***************Manipulando DOM***************
const novoLi = document.createElement("li"); //Criando novo li
novoLi.innerText = "Novo li criado pelo JS"; //Atribuindo texto ao novo li

const ulSelecionado = document.querySelector(".ul-form"); //Apontando onde está a ul
ulSelecionado.appendChild(novoLi); //Filho acrescentado com o appendChild()
ulSelecionado.removeChild(ulSelecionado.children[0]); //Com uma linha, deletamos um filho específico

ulSelecionado.querySelector(".li-teste-form").remove(); //Especificado dentro do pai, encontrado em elemento pelo querySelector e removido em sequência

//***************Eventos***************
const botaoTexto = document.querySelector(".botao-acao-1"); //Selecionado o botão
botaoTexto.addEventListener("click", (evento) => {
  evento.preventDefault(); //Criado um evento no botão. Desliga o reload da página com o preventDefault()

  const campoNome = document.querySelector(".input-nome"); //Seleciona o campo de entrada do nome
  if (campoNome.value == "") {
    //Verifica se está vazio
    alert("Campo de Nome vazio. Por favor insira um Nome.");
    return;
  }
  const novoNome = document.createElement("li"); //Cria um li
  novoNome.innerText = campoNome.value; //Atribui o valor do campo ao atributo criado
  const ulPai = document.querySelector(".ul-form"); //Aponta aonde está o elemento pai
  ulPai.appendChild(novoNome); //Adiciona um filho no elemento pai
  campoNome.value = ""; //Reseta o campo para uma nova entrada de dados
});

const botaoEmail = document.querySelector(".botao-acao-2"); //Seleciona o campo de entrada do nome
botaoEmail.addEventListener("click", (evento) => {
  evento.preventDefault();

  const campoEmail = document.querySelector(".input-email");
  if (campoEmail.value == "") {
    //Verifica se está vazio
    alert("Campo de E-mail vazio. Por favor insira um E-mail.");
    return;
  }
  const novoEmail = document.createElement("li"); //Cria um li
  novoEmail.innerText = campoEmail.value; //Atribui o valor do campo ao atributo criado
  const ulPai = document.querySelector(".ul-form"); //Aponta aonde está o elemento pai
  ulPai.appendChild(novoEmail); //Adiciona um filho no elemento pai
  campoEmail.value = ""; //Reseta o campo para uma nova entrada de dados
});

/***************Javascript Assíncrono***************
-Código assíncrono leva um tempo para ser executado, pode ser bem sucedido ou não
-Exemplos: chamada para api, interação com banco de dados
-Maneiras de lidar com o código: Callback (primeira solução), Promises (segunda solução com atualizações), Promises com Async/Await (solução atualmente mais atualizada)
= callbacks: onSuccess, onError. return onError(new Error(). onSuccess é a própria função passada)
  promises: 
*/

const criarLogin = (usuario, senha, callback, error) => {
  const erro = false; //Experimente trocar essa parte para ver como o código se comporta
  console.log({ usuario, senha });

  if (erro) {
    error(new Error("Erro ao logar no sistema!"));
    return;
  }
  callback();
};
const novoUsuarioTeste = criarLogin(
  "nome@gmail",
  123456,
  () => {
    setTimeout(() => {
      console.log("Usuário logado no sistema!");
    }, 1500);
  },
  (falha) => {
    console.log(falha);
  }
);
novoUsuarioTeste; //Exemplo de callback. Função passada como argumento de uma outra função e que podemos controlar quando será ativada. Passado adicionado o callback de acerto e outro de erro.
