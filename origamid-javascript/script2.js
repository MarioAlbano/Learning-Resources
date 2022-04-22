var a = window.document.getElementById("area");
a.addEventListener("click", clicar);
a.addEventListener("mouseover", entrar);
a.addEventListener("mouseout", sair);

function clicar() {
  a.innerText = "Clicou!";
  a.style.background = "yellow";
}

function entrar() {
  a.innerText = "Entrou!";
  a.style.background = "red";
}

function sair() {
  a.innerText = "Saiu!";
  a.style.background = "green";
}
