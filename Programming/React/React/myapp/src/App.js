import { Component } from "react";

class TeamGroup extends Component {
  render() {
    return (
      <div>
        <h1>Conheça nossa equipe:</h1>
        <Person
          name={this.props.name}
          charge={this.props.charge}
          age={this.props.age}
          insta={this.props.insta}
        />
      </div>
    );
  }
}

class Person extends Component {
  render() {
    return (
      <div>
        <h2>Olá eu sou o {this.props.name}</h2>
        <h3>Cargo: {this.props.charge}</h3>
        <h3>Idade: {this.props.age}</h3>
        <Socials insta={this.props.insta} />
        <hr />
      </div>
    );
  }
}

class Socials extends Component {
  render() {
    return (
      <div>
        <h4>Instagram pessoal: {this.props.insta}</h4>
      </div>
    );
  }
}

//For class components, we need render()
function App() {
  return (
    <div>
      <TeamGroup name="José" charge="Robotista" age="45" insta="Zé_dos_robos" />
      <TeamGroup name="Adebayor" charge="Atleta" age="28" insta="Adeebayo000" />
    </div>
  );
}

export default App;
