//Creating Object
let soccerPlayersObject = { Player1: "Pierre-Emerik Aubameyang", Player2: "Batshuayi", Player3: "Joshua Kimmich", Player4: "David Alaba" };
console.log(soccerPlayersObject);

//Destructuring Object
let { Player1: jogador1, Player2: jogador2, Player: jogador3, Player4: jogador4 } = soccerPlayersObject;
console.log(jogador1, jogador2, jogador3, jogador4);

//Creating Array
let soccerPlayersArray = ["Pierre-Emerik Aubameyang", "Batshuayi", "Joshua Kimmich", "David Alaba"];
console.log(soccerPlayersArray);

//Destructuring Array
let { 0: jogador } = soccerPlayersArray;
let [jogadorUm, jogadorDois, jogadorTres, jogadorQuatro] = soccerPlayersArray;
console.log(jogador);
console.log(jogadorUm, jogadorDois, jogadorTres, jogadorQuatro);