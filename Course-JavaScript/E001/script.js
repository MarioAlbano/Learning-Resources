let validateEmail = /\w+@+\w+.(com|com.br)/

console.log(validateEmail.test("marioalbanon@gmail.com"));
console.log(validateEmail.test("ignacio@hotmail.org"));