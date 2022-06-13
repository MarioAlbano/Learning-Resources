let brandTest = /[Marca:] [|Nike|Adidas|Puma|Asics]/;

console.log(brandTest.test("Marca: Nike"));
console.log(brandTest.test("Marca: Mcdonalds"));
console.log(brandTest.test("Marca: Puma"));