//Using some
const personObjects = [{ Mario: 27 }, { Franklin: 30 }, { John: 27 }, { Mbappe: 20 }];

console.log(personObjects.some(age => age.Mario === 27)); //Expected true

//Using every
const peopleStaff = [{ staffName: "John", age: 18 }, { staffName: "Mario", age: 18 }, { staffName: "Pericles", age: 18 }, { staffName: "Handersen", age: 18 }];

console.log(peopleStaff.every((age) => age.age == 18)); //Expected true