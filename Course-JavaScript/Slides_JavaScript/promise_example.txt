//Criando promessa
const myPromise = new Promise((resolve, reject) => {
    const name = "Mario";
    if (name == "Mario") {
        resolve("Está correto!");
    } else {
        reject("O úsuario Mario não foi encontrado!!");
    }
})

myPromise.then((data) => {
    console.log(data);
})