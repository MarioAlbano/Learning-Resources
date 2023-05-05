const userSet = ["Mario", 27, "Solteiro", "Brasileiro", "Segunda nacionalidade: Japonês"];

let info = userSet.unshift("Outra info");
console.log(info);
console.log(userSet);
console.log(info);

console.log(userSet.includes("Segunda nacionalidade: "));

console.log(userSet.indexOf(27));
console.log(userSet[2]);

console.log(userSet.length);