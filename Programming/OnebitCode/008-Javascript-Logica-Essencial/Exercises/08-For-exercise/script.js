const userNumber = prompt("Qual a tabuada desejada?");

for (i = 0; i <= 20; i++) {
  alert(`A tabuada do ${userNumber} vezes ${i} é:\n${userNumber * [i]}`);
}

alert("Finalizando...");