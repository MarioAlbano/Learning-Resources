const Challenge = () => {
    const variavelA = 20;
    const variavelB = 77;

    return (
        <div>
            <p>O primeiro número é {variavelA}</p>
            <p>O segundo número é {variavelB}</p>
            <button onClick={() => { console.log(variavelA + variavelB) }}>Clique aqui para ver a soma de ambos!</button>
        </div >
    )
}

export default Challenge;