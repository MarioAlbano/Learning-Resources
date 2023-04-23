import React, { Component } from "react";
import "./style.css";

class App extends Component {
  constructor(props) {
    super(props);
    this.state = {
      textPhrase: "",
    };

    this.openCookie = this.openCookie.bind(this);

    this.phrase = [
      "Às vezes a gente tem de ser meio louco mesmo, extremamente obstinado, porque a loucura funciona – desde que exista disciplina, um objetivo muito claro, pé no chão e a humildade de saber que a gente vai errar muito, vai aprender com os erros e continuar.” – Leila Velez, Instituto Beleza Natural.",
      "O fundamental é manter sempre a mesma obsessão em alcançar o sucesso. Ter sucesso não é apenas ter dinheiro, mas sim saber que uma ideia que parece impossível pode vir a ser uma empresa que irá quebrar paradigmas. – Romero Rodrigues, Buscapé.",
      "Nunca tive sala, ficava no meio de todos os funcionários. Não gosto de nada fechado. Eu gosto muito de gente e acho que todo gestor tem que gostar de gente. – Sônia Hess, Dudalina",
      "Digo isso há não menos de 50 anos. Não é superstição. O que acredito é que possamos nos motivar para a vida. Quando diz ‘estou cada vez melhor’, você erotiza, ilumina com amor, um olhar, um pensamento, e suas circunstâncias. Você vence a sombra. Assim, convocando a beleza, vence a tendência à banalização da vida, que por vezes predomina à nossa volta. – Luiz Seabra, Natura.",
      "´Não adianta só dar um salário para pessoa, porque não é só isso que segura alguém num emprego. É a qualidade de vida, é você conversar e entender as dores dos outros e saber que, às vezes, nem tudo vai estar bem. Não é só produzir, produzir e produzir.´ – Nath Finanças, YouTuber",
    ];
  }

  openCookie() {
    let state = this.state;
    let randomNumber = Math.floor(Math.random() * this.phrase.length);
    state.textPhrase = this.phrase[randomNumber];
    this.setState(state);
  }

  render() {
    return (
      <div className="main-container">
        <img
          src={require("./main-cookie.jpg")}
          className="container-img"
          alt="Fortune Cookie"
        />
        <Button nameButton="Abra o Cookie" btnAction={this.openCookie} />
        <h3 className="container-phrase">{this.state.textPhrase}</h3>
      </div>
    );
  }
}

class Button extends Component {
  render() {
    return (
      <div>
        <button className="container-button" onClick={this.props.btnAction}>
          {this.props.nameButton}
        </button>
      </div>
    );
  }
}

export default App;
