import React, { Component } from "react";

class App extends Component {
  constructor(props) {
    super(props);
    this.state = {
      form: {
        userName: "",
        userEmail: "",
        userPassword: "",
      },
    };

    this.formsData = this.formsData.bind(this);
  }

  formsData(e) {
    let updatedForm = this.state.form;
    updatedForm[e.target.name] = e.target.value;
    this.setState({ form: updatedForm });
  }

  render() {
    return (
      <div>
        <h2>Novo usuário</h2>
        <label>Nome: </label>
        <input
          type="text"
          name="userName"
          value={this.state.form.userName}
          onChange={this.formsData}
        />
        <br />

        <label>Email: </label>
        <input
          type="email"
          name="userEmail"
          value={this.state.form.userEmail}
          onChange={this.formsData}
        />
        <br />

        <label>Senha: </label>
        <input
          type="password"
          name="userPassword"
          value={this.state.form.userPassword}
          onChange={this.formsData}
        />
        <br />
        <br />

        <button type="submit">Enviar dados</button>

        <h3>{this.state.form.userName}</h3>
        <h3>{this.state.form.userEmail}</h3>
        <h3>{this.state.form.userPassword}</h3>
      </div>
    );
  }
}

export default App;
