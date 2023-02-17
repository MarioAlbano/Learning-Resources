//Variables in Javascript
const teacherName = "Matheus";
const teacherSurname = "Fraga";
console.log(`Nome do professor é ${teacherName} ${teacherSurname}`);

//Sum with variables
const simpleSum = (a, b) => console.log(a + b);
simpleSum(3, 2);

//Case sensitive differences in Javascript
const casesensitiveTest = () => {
  userName = "John";
  username = "Rodolf";
  console.log(userName);
  console.log(username);
};
casesensitiveTest();

//Reserved words in Javascript
// const const = "Random Text Here!" //Expected error

//We can have dynamics variables in Javascript
const dynamicsTest = (a, b) => {
  const completeName = a + " " + b;
  console.log(completeName);
};
dynamicsTest("John", "Jones");
dynamicsTest("Lyoto", "Machida");

//Using event onclick
const redirectUser = () => {
  window.location.href = "https://www.w3schools.com/js/js_window_location.asp";
};

const changeText = () => {
  document.querySelector("#area").innerText = prompt(
    "Qual o texto do parágrafo?",
  );
};

const changeText2 = () => {
  let area2 = document.querySelector("#area2");
  let exitProgram = false;

  do {
    let userText = prompt("Qual a nova mensagem de bem vindo?");
    if (userText) {
      area2.innerText = userText;
      exitProgram = true;
      alert(`Seu novo texto usado será "${userText}"`);
    } else {
      alert("Algo não válido!");
    }
  } while (exitProgram == false);
};

const infoFunction = (userName, userSurname, userAge) => {
  text = document.querySelector(".pChange");
  text.innerText = `Seu nome é ${userName}, sobrenome ${userSurname}, com a idade de ${userAge}`;
};

//Working with arrays
let marioArray = ["Mario", "Albano", 27];
console.log(marioArray);
console.log(marioArray.length);
console.log(marioArray[1]);

console.log(marioArray.indexOf("Batushuayi")); // -1 means that indexof dont finded anything inside the array
console.log(marioArray.indexOf(27));

let userArray = [00, 10, 20, 30, 40, 50, 60, 70, 80];
console.log(userArray);
userArray.pop();
console.log(userArray);
console.log(userArray.indexOf(30));
console.log(userArray.indexOf(3));
console.log(userArray);
userArray.shift("John");
console.log(userArray);

userArray[0] = "Jimmy";
console.log(userArray);

//Using while loop
let Variable_a = 0;
while (Variable_a < 2) {
  Variable_a++;
  console.log(Variable_a);
}

//Using for loop
for (i = 0; i <= 5; i++) {
  console.log(i);
}

//Using document.write
document.write("Este é somente um teste");

function chooseMenu() {
  const userSwitchOption = prompt("Qual opção do menu você deseja?");
  switch (userSwitchOption) {
    case "1":
      alert("Saindo um Refrigerante");
      break;
    case "2":
      alert("Saindo um Lanche");
      break;
    case "3":
      alert("Saindo uma Batata Frita");
      break;
    default:
      alert("Opção inválida! Tente novamente, por favor.");
  }
}

//setInterval and setTimeout examples
let iCounter = 0;
const infiniteCounter = () => {
  console.log(`O contador está em: ${iCounter}`);
  iCounter++;
};
const startTimer = setInterval(infiniteCounter, 1000);
startTimer;

//Stoping the timer
// clearInterval(startTimer);
