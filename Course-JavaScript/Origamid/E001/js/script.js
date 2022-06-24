let verdade = 1000000;

if (verdade == true) {
    console.log("É verdade");
} else if (typeof verdade === 'number') {
    console.log("É número");
} else if (verdade == false) {
    console.log("É mentira!");
}
