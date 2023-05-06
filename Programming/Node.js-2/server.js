//Buscando biblioteca http
const http = require("http");

//Criando servidor(req = passado pelo browser, res = resposta)
const server = http.createServer((req, res) => {
  //Devolvendo uma resposta para o front
  console.log(req.method);
  console.log(req.url);
  res.statusCode = 200; //Respondedo que deu certo
  res.end("<h1>Hello World<h1>"); //Mandando uma tag como resposta
});

//Deixar o server ouvindo a porta 3000, para que execute os códigos
server.listen(3000, () => {
  console.log("Servidor Ativo!");
});
