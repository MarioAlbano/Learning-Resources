var a = window.document.getElementById("area");

function clicar() {
    a.innerText = "Clicou!";
    a.style.background = "red"
}

function entrar() {
    a.innerText = "Entrou com o mouse"
    a.style.background = "yellow"
}

function sair() {
    a.innerText = "Saiu com o mouse"
    a.style.background = "blue"
}