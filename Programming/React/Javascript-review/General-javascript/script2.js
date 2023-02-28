if (localStorage.userName == undefined) {
  localStorage.userName = prompt("Por favor defina seu nome");
} else {
  alert(`Bem vindo ${localStorage.userName}`);
  localStorage.removeItem("userName");
}
