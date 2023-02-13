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
