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
