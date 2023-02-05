//Using includes
const vetorNumbers = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
console.log(vetorNumbers.includes(2)); //Expected true

//Using endsWith
const myName = "Mario";
console.log(myName.startsWith("Mar")); //Expected true
console.log(myName.startsWith("mar")); //Expected false

//Using startsWith 
console.log(myName.endsWith("rio")); //Expected true
console.log(myName.startsWith("ria")); //Expected false