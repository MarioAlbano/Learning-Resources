import { Component } from "react";
class App extends Component {
  constructor(props) {
    super(props);
    this.state = {
      status1: false,
    };
    this.logIn = this.logIn.bind(this);
    this.logOff = this.logOff.bind(this);
  }

  logIn() {
    this.setState({ status1: true });
  }

  logOff() {
    this.setState({ status1: false });
  }

  render() {
    return (
      <div>
        {this.state.status1 ? (
          <div>
            {" "}
            <h2>Usuário logado. Bem vindo ao sistema!</h2>
            <button onClick={this.logOff}>Clique para Deslogar</button>
          </div>
        ) : (
          <div>
            {" "}
            <h2>Usuário deslogado. Clique no botão abaixo para Logar</h2>
            <button onClick={this.logIn}>Clique para Logar</button>
          </div>
        )}
      </div>
    );
  }
}

export default App;
