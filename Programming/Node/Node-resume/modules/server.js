const http = require("http");
const url = require("url");

const port = 8080;

const server = http.createServer((req, res) => {
  const analiseUrl = url.parse(req.url, true);
  const caminho = analiseUrl.pathname;
  const mensagemJSON = {
    mensagem: "Criado arquivo JSON com o Node.js",
    horario: new Date(),
  };

  if (caminho === "/bem-vindo") {
    res.setHeader("Content-Type", "text/plain");
    res.end("Seja bem vindo!");
  } else if (caminho === "/sobre") {
    res.setHeader("Content-Type", "application/json");
    res.end(JSON.stringify(mensagemJSON));
  } else {
    res.statusCode = 404;
    res.setHeader("Content-Type", "text/plain; charset=utf-8");
    res.end("Página não encontrada. Tente novamente!");
  }
});

server.listen(port, () => {
  console.log("Sucesso ao iniciar servidor");
});
