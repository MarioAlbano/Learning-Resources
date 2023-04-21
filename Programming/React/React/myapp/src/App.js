import { Component } from "react";

class App extends Component {
  constructor(props) {
    super(props);
    this.state = {
      name: "Jonny",
      counter: 0,
    };

    this.increaseCounter = this.increaseCounter.bind(this);
    this.decreaseCounter = this.decreaseCounter.bind(this);
  }

  increaseCounter() {
    let state = this.state;
    state.counter += 1;
    this.setState(state);
  }

  decreaseCounter() {
    let state = this.state;
    if (state.counter === 0) {
      alert("Não é possível diminuir!");
    } else {
      state.counter -= 1;
      this.setState(state);
    }
  }

  render() {
    return (
      <div>
        <h1>Teste</h1>
        <button onClick={this.increaseCounter}>+</button>
        {this.state.counter}
        <button onClick={this.decreaseCounter}>-</button>
      </div>
    );
  }
}

export default App;
