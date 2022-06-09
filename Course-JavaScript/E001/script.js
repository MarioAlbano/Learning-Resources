function maxRandom(a, b, c) {
    a = Math.floor(Math.random() * a) + 1;
    b = Math.floor(Math.random() * b) + 1;
    c = Math.floor(Math.random() * c) + 1;
    console.log(`The max number is ${Math.max(a, b, c)}`);
}

console.log(maxRandom(10, 15, 20));