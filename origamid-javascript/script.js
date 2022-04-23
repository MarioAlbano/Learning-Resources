Function somar() {}

var numero1 = window.document.getElementById("numero1");
var numero2 = window.document.getElementById("numero2");
var res = window.document.getElementById("res");
var n1 = Number(numero1.value);
var n2 = Number(numero2.value);
var s = n1 + n2;
res.innerHTML =
    `Soma é ${s}`;
}