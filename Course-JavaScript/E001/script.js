let validateSite = /www.\w+.(com|com.br)/;

console.log(validateSite.test("www.google.com.br"));
console.log(validateSite.test("www.google.org"));
console.log(validateSite.test("www.teste.com"));
console.log(validateSite.test("www.w.com"));