import React, { Component } from "react";

class App extends Component {
  constructor(props) {
    super(props);
    this.state = {
      userLogin: "",
      userPassword: "",
      userGender: "male",
    };
    this.changeEmail = this.changeEmail.bind(this);
    this.optionGender = this.optionGender.bind(this);
  }

  changeEmail(e) {
    this.setState({ userLogin: e.target.value });
  }

  optionGender(e) {
    this.setState({ userGender: e.target.value });
  }

  render() {
    return (
      <div>
        <h2>Entrar no sistema</h2>

        <label>Login: </label>
        <input
          type="email"
          name="email"
          gender="male"
          value={this.state.userLogin}
          onChange={this.changeEmail}
        />
        <br />
        <br />

        <label>Senha: </label>
        <input
          type="password"
          name="password"
          value={this.state.userPassword}
          onChange={(e) => {
            this.setState({ userPassword: e.target.value });
          }}
        />
        <br />
        <br />

        <label>Sexo: </label>
        <select
          name="gender"
          value={this.state.userGender}
          onChange={this.optionGender}
        >
          <option value="male">Masculino</option>
          <option value="female">Feminino</option>
        </select>

        <h3>{this.state.userLogin}</h3>
        <h3>{this.state.userPassword}</h3>
        <h3>{this.state.userGender}</h3>
      </div>
    );
  }
}

export default App;
