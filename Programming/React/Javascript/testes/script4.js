//Map example
const numbersOneToFive = [1, 2, 3, 4, 5];
const newList = numbersOneToFive.map((item) => item * 3);
console.log(newList);

//Index in map example
const newList2 = numbersOneToFive.map((item, index) => item * 3 + index);
console.log(newList2);

//Reduce example
const reduceExample = numbersOneToFive.reduce((item, index) => item + index);
console.log(reduceExample);

//Find example
const findExample = numbersOneToFive.find((item) => item === 2);
console.log(findExample);
const findExample2 = numbersOneToFive.find((item) => item === 2222);
console.log(findExample2); //Expected undefined

//Includes example
const randomArray = ["Mario", "Hamilton", "Ronaldo"];
console.log(randomArray.includes("Mario")); //Expected true
console.log(randomArray.includes("Handersen")); //Expected false

//startsWith example
const randomName = "Batshuayi";
console.log(randomName.startsWith("B")); //Expected true
console.log(randomName.startsWith("T")); //Expected false

const randomName2 = "Reus";
console.log(randomName2.endsWith("S")); //Expected false
console.log(randomName2.endsWith("s")); //Expected true
