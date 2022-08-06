const personName = "Rebere";
let newName = "";

for (i = 0; i < personName.length; i++) {
    if (personName[i] != "e") { newName += personName[i] }
    else {
        newName += "i"
    }
}

console.log(newName);