// let weight;

// console.log(typeof weight);

// const name = "Mario";
// let age = 27;
// let starts = 4.75;
// let isSubscribed = True;


let student = {
    name: "Mario",
    age: 27,
    starts: 4.75,
    weight: 88.5,
    isSubscribed: true,
};
console.log(student);

console.log(`${student.name} de idade ${student.age} e ${student.weight} kg.`);

let students = [student];

console.log(students[0]);

const studentTwo = {
    name: "John",
    age: 17,
    starts: 2.75,
    weight: 68.5,
    isSubscribed: false,
}

students[1] = studentTwo;

console.log(students[1]);