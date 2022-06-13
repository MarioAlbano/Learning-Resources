let idTest = /\d+ID\b/;

console.log(idTest.test("1101092ID"));
console.log(idTest.test("1101092id"));
console.log(idTest.test("asdjkasjdasjID"));