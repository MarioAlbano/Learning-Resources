const http = require("http");
const url = require("url");

const port = 8080;

const server = http.createServer((req, res) => {
  const analiseUrl = url.parse(req.url, true);
  const caminho = analiseUrl.pathname;

  if (caminho === "/bem-vindo") {
    res.setHeader("Content-Type", "text/plain");
    res.end("Seja bem vindo!");
  }
});

server.listen(port, () => {
  console.log("Sucesso ao iniciar servidor");
});
