class enderecoCliente {
    constructor(rua, bairro, cidade, estado) {
        this.rua = rua;
        this.bairro = bairro;
        this.cidade = cidade;
        this.estado = estado;
    }

    attRua(att) {
        this.rua = att;
    }
    attBairro(att) {
        this.bairro = att;
    }
    attCidade(att) {
        this.cidade = att;
    }
    attEstado(att) {
        this.estado = att;
    }
}

let enderecoCliente01 = new enderecoCliente("Estrada st ines", "St ines", "sp", "sp");
console.log(enderecoCliente01);

enderecoCliente01.attRua("Rua ali por perto");
enderecoCliente01.attBairro("Rua ali por perto");
enderecoCliente01.attCidade("Rua ali por perto");
enderecoCliente01.attEstado("Rua ali por perto");

console.log(enderecoCliente01);