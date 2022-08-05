//Comentário de uma linha
/*Comentário de
Múltiplas linhas*/

const nomeMaior = prompt("Pessoa A: Qual o seu nome?");
const idadeMaior = prompt("Pessoa A: Qual a sua idade");

const nomeMenor = prompt("Pessoa B: Qual o seu nome?");
const idadeMenor = prompt("Pessoa B: Qual a sua idade?");

let soma = (idadeMaior - idadeMenor);

alert(`${nomeMaior} ${idadeMaior} \n\n ${nomeMenor} ${idadeMenor}`);
alert(`A diferença entre a idade é de ${soma} anos`);