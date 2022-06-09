let arrayOne = [1, 2, 3, 4, 5, 6, 7, 8];
let arrayTwo = ["a", "b", "c", "d"];

function verifyingLength(x) {
    if (x.length < 5) {
        console.log("Poucos elementos");
    } else {
        console.log(x.length);
    }
}

verifyingLength(arrayOne);
verifyingLength(arrayTwo);