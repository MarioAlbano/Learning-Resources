const TemplateExpressions = () => {

    const name = "Mario"
    let info = {
        profissao: "Estudante",
        idade: "27",
        localizado: "São Paulo"
    };
    return (
        <div>
            <h1>Olá {name}</h1>
            <p>Sobre você: {info.localizado}</p>
            <p>{5 + 5}</p>
            <p>{console.log("Testando o console.log no react")}</p>
        </div>
    )
}

export default TemplateExpressions;