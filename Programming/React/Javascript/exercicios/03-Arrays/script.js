//Creating arrays
let myList = ["Batshuayi", 18];
console.log(myList);

//find in array, if -1 means that not found
console.log(myList.indexOf("Batshuayi"));
console.log(myList.indexOf("Batshuai"));

//Grouping elements
const joinText = myList.join(" / ");
console.log(joinText);

//Add element in beginning
myList.unshift("Azpilicueta");
console.log(myList);
//Add element in the final
myList.push("Wayne Rooney");
console.log(myList);

//Removing the first element
myList.shift();
console.log(myList);

//Removing the last element
myList.pop()
console.log(myList);

//Changing array element value
myList[0] = "Hector Bellerín";
console.log(myList);

//If with indexOf
myList.unshift("Batshuayi");
console.log(myList);
if (myList.indexOf("Batshuayi" > -1)) {
  console.log("Jogador encontrado!");
} else {
  console.log("Este jogador não existe em nosso banco de dados!");
}
