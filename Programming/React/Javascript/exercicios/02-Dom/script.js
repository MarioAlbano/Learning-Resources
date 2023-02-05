function changeText() {
  let myDiv = document.getElementById('divContainer');
  let textName = prompt("Qual é seu nome?");
  let textForname = prompt("E qual seu sobrenome?");
  if (textName == '' || textName == null || textForname == '' || textForname == null) {
    alert("Você não digitou nada, tente novamente!");
  }
  else {
    myDiv.innerHTML = textName + ' ' + textForname;
  }

}

function autoText(name, age) {
  const yourName = document.getElementById('buttonName');
  const nickName = prompt("Qual o seu sobrenome?");
  yourName.innerHTML = `Seu nome é ${name} ${nickName}, com ${age} anos!`;
}