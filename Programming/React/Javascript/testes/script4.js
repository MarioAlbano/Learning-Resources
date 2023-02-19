//Map example
const numbersOneToFive = [1, 2, 3, 4, 5];

const newList = numbersOneToFive.map((item) => {
  return item * 3;
});
console.log(newList);

//Index inside map
const newList2 = numbersOneToFive.map((item, index) => {
  return item * 3 + index;
});
console.log(newList2);

//Reduce
const reduceExample = numbersOneToFive.reduce((item, index) => {
  return item + index;
});
console.log(reduceExample);

const findExample = numbersOneToFive.find((item, anotherItem) => {
  return item === 2;
});
console.log(findExample);
const findExample2 = numbersOneToFive.find((item, anotherItem) => {
  return item === 2222;
});
console.log(findExample2); //Expected undefined
