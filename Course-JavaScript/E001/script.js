let ipTest = /\d{1-3}\.\d{1-3}\.\d{1-3}\.\d{1-3}/

console.log(ipTest.test("127777777777777.0.0.1"));
console.log(ipTest.test("127.0.000.1"));
console.log(ipTest.test("127.00.0.1"));
console.log(ipTest.test("127.0.0.11"));