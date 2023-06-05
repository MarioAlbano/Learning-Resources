const path = require("path");

const lendoDocumento = path.basename(__filename);
console.log(lendoDocumento);

const lendoDiretorio = path.dirname(__filename);
console.log(lendoDiretorio);

const lendoExtensao = path.extname(__filename);
console.log(lendoExtensao);

const construirCaminho = path.join(__dirname, "teste", "teste.html");
console.log(construirCaminho);
