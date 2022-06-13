let onlyCaps = /^[^a-z]*$/;


console.log(onlyCaps.test("TESTE"));
console.log(onlyCaps.test("teste"));
console.log(onlyCaps.test("123"));
console.log(onlyCaps.test("Testando"));
console.log(onlyCaps.test("TEEESSSTTTEEEEE"));