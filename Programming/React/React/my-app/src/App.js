import React, { Component } from "react";

class MyTeam extends Component {
  render() {
    return (
      <div>
        <h2>Este é um h2 de um componente de classe</h2>
        <h3>Meu nome é {this.props.firstName}</h3>
        <h3>E meu sobrenome é {this.props.forName}</h3>
        <About firstName="John Jones" forName="Bones" />
        <More Example="EscritoEmUmComponenteFuncional!" />
      </div>
    );
  }
}

const More = (props) => {
  return (
    <div>Este é um exemplo de um componente funcional {props.Example}</div>
  );
};

class About extends Component {
  render() {
    return (
      <div>
        <h3>Meu nome é {this.props.firstName}</h3>
        <h3>E meu sobrenome é {this.props.forName}</h3>
      </div>
    );
  }
}

export default function App() {
  return (
    <div>
      <MyTeam firstName="Mario" forName="Albano" />
    </div>
  );
}
