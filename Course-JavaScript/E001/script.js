let validadeYear = /(0[1-9]|[12][0-9]|3[01])[/](0[1-9]|1[012])[/](19\d{2}|20[0-2][0[1-9]|1[0-9]|2[0-2])/

console.log(validadeYear.test("28/06/1995"));
console.log(validadeYear.test("abc/06/1995"));
console.log(validadeYear.test("31/07/1945"));
console.log(validadeYear.test("12/12/1999"));
console.log(validadeYear.test("31/01/2023"));
console.log(validadeYear.test("12/06/2025"));
console.log(validadeYear.test("31/01/2077"));

2000
2010
2019
2020
2022