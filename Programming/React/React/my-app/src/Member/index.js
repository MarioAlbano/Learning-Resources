import React, { Component } from "react";

export default class Member extends Component {
  constructor(props) {
    super(props);
    this.state = {
      default: "Visitante",
    };
    this.loguinUser = this.loguinUser.bind(this);
    this.logOff = this.logOff.bind(this);
  }

  loguinUser = () => {
    this.setState({ default: "Mario" });
  };

  logOff = () => {
    this.setState({ default: "Visitante" });
  };

  render() {
    return (
      <div>
        <h2>Bem vindo {this.state.default}!</h2>
        <button onClick={this.loguinUser}>Entrar como Mario</button>
        <button onClick={this.logOff}>Sair do sistema</button>
      </div>
    );
  }
}
