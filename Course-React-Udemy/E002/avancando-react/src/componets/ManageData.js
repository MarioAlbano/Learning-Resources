import React, { useState } from "react";



const ManageData = () => {
    const [contador, contadorSoma] = useState(0);
    return (
        <div>
            <p>Você clicou tantas vezes {contador}</p>
            <button onClick={() => { contadorSoma(contador + 1) }}>Clique aqui!</button>
        </div>
    )
}

export default ManageData