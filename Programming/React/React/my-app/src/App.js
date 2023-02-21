import React, { Component } from "react";

class App extends Component {
  constructor(props) {
    super(props);
    this.state = {
      myCounter: 0,
    };
    this.increase = this.increase.bind(this);
  }

  increase = () => {
    let state = this.state;
    state.myCounter += 1;
    this.setState(state);
  };

  decrease = () => {
    let state = this.state;
    state.myCounter -= 1;
    this.setState(state);
  };

  reset = () => {
    let state = this.state;
    state.myCounter = 0;
    this.setState(state);
  };

  render() {
    return (
      <div>
        <h1>Este é um teste pois meu último arquivo não renderizou</h1>
        <h2>Contador: {this.state.myCounter}</h2>
        <button onClick={this.decrease}>Diminuir</button>
        <button onClick={this.increase}>Aumentar</button>
        <button onClick={this.reset}>Resetar</button>
      </div>
    );
  }
}

export default App;
