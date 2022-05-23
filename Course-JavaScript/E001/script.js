function saudacao(nome) {
    if (typeof nome != "string") {
        throw new Error("(Agora estou criando uma mensagem de erro aqui!!!) O parâmetro nome precisa ser uma string")
    }
    else {
        console.log(`Olá ${nome}!`);
    }
}

saudacao("Rasputim");
saudacao(12211221)