import React, { Component } from "react";

class App extends Component {
  constructor(props) {
    super(props);
    this.state = {
      hour: "00:00:00",
    };
  }

  componentDidMount() {
    setInterval(() => {
      this.setState({ hour: new Date().toLocaleTimeString() });
    }, 1000);
  }

  componentDidUpdate() {
    console.log("Atualizou o State!");
  }

  render() {
    return (
      <div>
        <h1>Horário de Brasília: {this.state.hour}</h1>
      </div>
    );
  }
}

export default App;
