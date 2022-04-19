var n1 = parseFloat(prompt("Número do jogador 1:"));
var n2 = parseFloat(prompt("Número do jogador 2:"));
sorteio = parseInt(Math.random() * 2);

alert("O resultado do número sorteado é: " + sorteio);

if (n1 === n2) {
  alert("Empate, tentem novamente");
} else {
  if (sorteio === 1) {
    if (n1 > n2) {
      alert("Jogador 1 venceu!");
    } else {
      alert("Jogador 2 venceu!");
    }
  } else {
    if (sorteio === 0) {
      if (n1 < n2) {
        alert("Jogador 1 venceu!");
      } else {
        ("Jogador 2 venceu!");
      }
    }
  }
}
