function amostraUm() {
    let nome = "Mario",
        idade = 26,
        profissao = "Developer";
    // return `${nome}, ${idade}, ${profissao}`;
    function amostraDois() {
        let nome = "Marcia",
            idade = 49,
            profissao = "Advogada";
        return `${nome}, ${idade}, ${profissao}`;
    }
    return amostraDois()
}

console.log(amostraUm());