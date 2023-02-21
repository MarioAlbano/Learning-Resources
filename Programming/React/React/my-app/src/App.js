import React, { Component } from "react";

class App extends Component {
  constructor(props) {
    super(props);
    this.state = {
      myStatus: true,
    };
    this.desactive = this.desactive.bind(this);
    this.active = this.active.bind(this);
  }
  
  desactive = () => {
    this.setState({ myStatus: false });
  };

  active = () => {
    this.setState({ myStatus: true });
  };

  render() {
    return (
      <div>
        {this.state.myStatus ? (
          <h1>Bem vindo usuário logado</h1>
        ) : (
          <h1>Bem vindo usuário deslogado!</h1>
        )}
        <button onClick={this.desactive}>Desativar Usuário</button>
        <button onClick={this.active}>Ativar Usuário</button>
      </div>
    );
  }
}

export default App;
