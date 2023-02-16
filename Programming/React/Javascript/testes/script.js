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

let marioArray = ["Mario", "Albano", 27];
console.log(marioArray);
console.log(marioArray.length);
console.log(marioArray[1]);

console.log(marioArray.indexOf("Batushuayi")); // -1 means that indexof dont finded anything inside the array
console.log(marioArray.indexOf(27));

const userArray = [0, 1, 2, 3, 4, 5, 6, 7, 8];
console.log(userArray);
userArray.pop();
console.log(userArray);
