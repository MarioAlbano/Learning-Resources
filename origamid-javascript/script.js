var n1 = parseFloat(prompt("Digite sua primeira nota"));
var n2 = parseFloat(prompt("Digite sua segunda nota"));
var media = parseFloat((n1 + n2) / 2);

if ( n1 === 0 || n2 === 0 || media < 5) {
    alert("Você foi reprovado");
}
else {
    alert("Sua primeira nota foi " + n1 + ", e a segunda foi " + n2 + ". Sua média é " + media);
}