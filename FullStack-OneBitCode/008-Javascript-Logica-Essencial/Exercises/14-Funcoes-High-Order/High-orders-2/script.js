//Select each element with For
const characters = [
  { level: 42, name: "Thrall", race: "Orc", class: "Xamã" },
  { level: 28, name: "Garrosh", race: "Orc", class: "Guerreiro" },
  { level: 35, name: "Varok", race: "Orc", class: "Guerreiro" },
  { level: 35, name: "Uther", race: "Humano", class: "Paladino" },
  { level: 26, name: "Jaina", race: "Humano", class: "Maga" },
  { level: 39, name: "Tyrande", race: "Elfo Noturno", class: "Sacerdotisa" },
  { nivel: 29, name: "Muradin", raca: "Anão", class: "Guerreiro" },
];

let selectedCharacters = [];

for (i = 0; i < characters.length; i++) {
  selectedCharacters.push(characters[i].name);
}

console.log(selectedCharacters);

//Using map for the same task
const selectedCharacters2 = characters.map(function (character) {
  return character.name;
});

console.log(selectedCharacters2);