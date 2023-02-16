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

// const changeButton = () => {
//   this.innerText = prompt("Qual o meu nome?");
// };
