const fs = require("fs");
const path = require("path");

fs.mkdir("pastaCriadaFs", (err) => {
  if (err) {
    console.error(err);
    return;
  }
  console.log("Diretório criado com sucesso!");
});

fs.writeFile(
  path.join(__dirname, "teste.html"),
  "Olá mundo! Estou criando este texto com o Node!",
  "utf8",
  (err) => {
    if (err) {
      console.log("Algo deu errado!");
      return;
    }
    console.log("Arquivo criado com sucesso!");
  }
);

setTimeout(() => {
  fs.appendFile(
    path.join(__dirname, "teste.html"),
    "Olá mundo! Estou alterando um arquivo já criado com o Node!",
    "utf8",
    (err) => {
      if (err) {
        console.error("Erro ao alterar arquivo!");
        return;
      }
      console.log("Arquivo alterado com sucesso!");
    }
  );
}, 1500);

setTimeout(() => {
  fs.readFile(path.join(__dirname, "teste.html"), "utf8", (err, data) => {
    if (err) {
      console.log("Erro ao ler aquivo");
      return;
    }
    console.log("Arquivo identificado! Fazendo a leitura...");
    console.log(data);
  });
}, 2000);
