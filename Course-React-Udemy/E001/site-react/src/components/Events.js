const Events = () => {
    const RenderizandoAlgo = (x) => {
        if (x) {
            return (
                <div>
                    <h1>Este é um texto renderizado</h1>
                </div>)
        } else {
            return (
                <div>
                    <h1>Este é outro texto renderizado</h1>
                </div>)
        }

    }


    return (
        <div>
            <div>
                <button className="botao-evento" onClick={() => { document.querySelector(".botao-evento").style.background = "red" }}>Clique aqui para mudar a cor de fundo!</button>
            </div>
            {RenderizandoAlgo("x")}
            {RenderizandoAlgo("x")}
        </div >
    )
}

export default Events;