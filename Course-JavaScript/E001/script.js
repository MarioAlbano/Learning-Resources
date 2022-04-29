function decrementaPares(x) {
  for (x; x > 0; x--) {
    if (x % 2 == 0) {
      console.log(x + " é um número par");
    }
  }
}

decrementaPares(100000);
