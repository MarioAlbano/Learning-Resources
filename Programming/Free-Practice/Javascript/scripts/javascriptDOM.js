//Methods and This examples
const methodExample = {
  userName: "Mario",
  nickName: "Solid-Gain",
  sayMyName() {
    console.log(this.userName + " " + this.nickName);
  },
};
methodExample.sayMyName();

//Recursive functions example
let recursiveCount = 0;
const recursiveFunction = () => {
  if (recursiveCount <= 5) {
    console.log(recursiveCount);
    recursiveCount++;
    recursiveFunction();
  }
};

recursiveFunction();

//Testing ternary operators
const userPersonAge = 16;
const userPersonName = userPersonAge > 10 ? "Pedro" : "Heimish";

console.log(userPersonName);

const objectPerson = {
  personName: "Mario",
  personAge: 27,
  personIsMarried: false,
};

//Destructor example
const { personName, personAge, personIsMarried } = objectPerson;
console.log(personName);
console.log(personAge);
console.log(personIsMarried);

const randomArray = [1, 2, 3, 5, 6, 7, 8];

randomArray.map()