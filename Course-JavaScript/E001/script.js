let a = 2;
let b = 3;
let c = 4;

if (c > a) {
    a = b;
    debugger;
}

for (let i = 10; i > 0; i--) {
    b++;
    a = a + c + 1;
    debugger;
}