//Using rest operator
function register(x, ...y) {
  finalList = [...x, ...y];
  return finalList;
}
let users = ["Amanda", "Francisca"];

console.log(register(users, "Ingrid", "Chayenne"));