//Creating a function
let i = 0;
function delayer() {
  i++
  console.log(i);
}

let timer = setInterval(delayer, 1000);