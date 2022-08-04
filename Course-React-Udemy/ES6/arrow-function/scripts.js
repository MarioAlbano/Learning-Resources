//Testando variáveis var explicando o por que do uso de let e const
var varA = 10;
var varB = 20;

if (varB > varA) {
    var x = 5;
    console.log(x);
}

// console.log(x); -> Aqui o var vaza do escopo

for (let i = 0; i < 5; i++) {
    console.log(i)
}
// console.log(i); -> Aqui o let não vaza do escopo

const name = "Alice";
() => {
    const name = "Hamilton";
    console.log(name);
}
console.log(name);