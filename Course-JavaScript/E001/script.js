class address {
    constructor(road, district, city, state) {
        this.road = road;
        this.district = district;
        this.city = city;
        this.state = state;
        console.log(`Sua rua é ${this.road}, o distrito é ${district}, a cidade é ${this.city} e o estado é ${this.state}`);
        console.log("Digite para alterar: 1 - Rua; 2 - Distrito; 3 - Cidade; 4 - Estado")
    }
    change(x, y) {
        if (x == 1) {
            this.road = y;
        }
        if (x == 2) {
            this.district = y;
        }
        if (x == 3) {
            this.dity = y;
        }
        if (x == 4) {
            this.state = y;
        }
        console.log(`Sua rua é ${this.road}, o distrito é ${this.district}, a cidade é ${this.city} e o estado é ${this.state}`);
        console.log("Digite para alterar: 1 - Rua; 2 - Distrito; 3 - Cidade; 4 - Estado")
    }
}

let addresOne = new address("Estrada Sanda Ines", "MP", "SP", "São Paulo");

addresOne.change(1, "Est Mun prefeito doutor sarkis tellian");