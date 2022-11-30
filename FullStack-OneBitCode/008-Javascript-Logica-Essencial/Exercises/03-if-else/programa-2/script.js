//Creating first character
const firstCharacter = prompt("Digite o nome do primeiro personagem");
let firstCharacterPower = parseFloat(prompt("Digite o poder de ataque do primeiro personagem"));

//Creating second character
const secondCharacter = prompt("Digite o nome do segundo personagem");
let secondCharacterLife = parseFloat(prompt("Digite a quantidade de vida do segundo personagem"));
let secondCharacterDefense = parseFloat(prompt("Digite o poder de defesa do segundo personagem"));
let secondCharacterShield = parseFloat(prompt("Digite 1 se o segundo personagem tiver escudo ou 2 se não tiver escudo"));
let damageCharacter;

//Creating the system
if ((firstCharacterPower > secondCharacterDefense) && secondCharacterShield == "2") {
  damageCharacter = (firstCharacterPower - secondCharacterDefense);
  alert(`Jogador ${firstCharacter} atingiu ${secondCharacter} com um dano de ${damageCharacter}`);
}
else if ((firstCharacterPower > secondCharacterDefense) && secondCharacterShield == "1") {
  damageCharacter = (firstCharacterPower - secondCharacterDefense) / 2;
  alert(`Jogador ${firstCharacter} atingiu ${secondCharacter} com um dano de ${damageCharacter}`);
}
else if ((firstCharacterPower < secondCharacterDefense)) {
  damageCharacter = 0;
  alert(`Jogador ${firstCharacter} atingiu ${secondCharacter} e não causou dano algum!`);
}

//Display info
alert(`Personagem ${firstCharacter}: Poder de ataque: ${firstCharacterPower}. \nPersonagem ${secondCharacter}: Vida restante ${secondCharacterLife - damageCharacter}. Poder de defesa ${secondCharacterDefense}. \nTotal de dano da última rodada ${damageCharacter}.`)