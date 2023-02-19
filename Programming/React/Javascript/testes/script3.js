//Creating object
const MarioAlbano = {
  userName: "Mario",
  userAge: 27,
  isMarried: false,
};

//Using Desconstructor
let { userName } = MarioAlbano;
console.log(userName);
let { userAge, isMarried } = MarioAlbano;
console.log(userAge);
console.log(isMarried);

//Using Desconstructor and change the variable name
let { userName: usuarioNome } = MarioAlbano;
console.log(usuarioNome);

//Using Destructor in arrays
let usersName = ["João", "Felix", "Jimmy", "Jonnhy"];
let { 0: usuarioDelSistema } = usersName;
console.log(usuarioDelSistema);
//Another way
let [Joao, Felix, Jimmy] = usersName;
console.log(Joao, Felix, Jimmy);
// console.log(Jonnhy); Expected error

//Spread Operator in arrays
const numberOneToFive = [0, 1, 2, 3, 4, 5];
const numberOneToTen = [...numberOneToFive, 6, 7, 8, 9, 10];
console.log(numberOneToTen);

//Spread in Objects
const myPersonObject = {
  myName: "Mario",
  myAge: 27,
  myProfession: "Developer",
};

const myPersonObjectPlus = {
  ...myPersonObject,
  isMarried: false,
  doingExercises: false,
  weight: 90,
};

console.log(myPersonObjectPlus);

//Real exemple Spread Operator
function registerPersonJob(inputObject) {
  let newData = {
    ...inputObject,
    jobArea: "IT",
    company: "Tech Bank inc",
    country: "Brasil",
  };
  console.log(newData);
}
registerPersonJob(myPersonObjectPlus);
