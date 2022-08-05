alert("Bem-vindo! A seguir pediremos que informe alguns dados");

let perguntaNome = prompt("Qual o seu nome?");
let perguntaIdade = prompt("Qual a sua idade?");
let perguntaConfirma = confirm(`Sua nome é ${perguntaNome} e possui ${perguntaIdade} anos?`)

alert(`${perguntaNome} \n ${perguntaIdade} \n ${perguntaConfirma} `);

//Comentário de uma linha
/*Comentário de
Múltiplas linhas*/