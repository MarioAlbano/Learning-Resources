const fs = require("fs");

fs.mkdir("pastaCriadaFs", (err) => {
  if (err) {
    console.error(err);
    return;
  }
  console.log("Diretório criado com sucesso!");
});
