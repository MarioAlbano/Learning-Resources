function textLength(text) {
    if (text.length > 10) {
        console.log(`Texto muito longo`);
    } else {
        console.log(`Texto dentro do limite`);
    }
}

textLength("Textando esse texto aqui para ver se contém mais de dez caracteres!");
textLength("Olá");