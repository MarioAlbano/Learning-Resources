const TemplateExpressions = () => {
    let myName = "Mario";
    let soccerPlayer = { name: "Timo Werner", nationality: "Germany", currentClub: "Chelsea F.C." }

    return (
        <div>
            <p>Este texto é de outro componente que carrega a variável contendo {myName}</p>
            <p>Jogador da variável objeto: {soccerPlayer.name}</p>
            <p>{(4 + 4) / 2}</p>
            <p>{console.log("JSX React")}</p>
        </div>
    )
}

export default TemplateExpressions;