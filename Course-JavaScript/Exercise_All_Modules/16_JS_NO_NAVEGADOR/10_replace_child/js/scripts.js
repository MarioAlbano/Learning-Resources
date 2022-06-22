let lista = document.createElement("ul");

for (i = 0; i < 15; i++) {
    let item = document.createElement("li");

    let texto = document.createTextNode("texto lista DOM");
    item.appendChild(texto);

    lista.appendChild(item);
}

let container = document.getElementById("container-principal");

container.appendChild(lista);