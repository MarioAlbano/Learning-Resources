const path = required("path");
console.log(path.basename(__filename));

//meus módulos
const myModule = require("./exports");

console.log(myModule);