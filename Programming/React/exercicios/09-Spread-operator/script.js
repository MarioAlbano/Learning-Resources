//Creating spread operator in a function
function addInfo() {
  defaultObj = { race: "Human", country: "Brazil", alive: "Yes" };
  userObject = { ...defaultObj, name: "Matheus", age: 24, nickname: "Fraga" }
  return userObject;
}

console.log(addInfo());

//Using spread operator in a vetor
let defaultVetor = [0, 1, 2, 3];
const newVetor = [...defaultVetor, 4, 5, 6];
console.log(newVetor);