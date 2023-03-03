import React from "react";

class MyComponent extends React.Component {
  constructor(props) {
    super(props);
    this.state = {
      userName: "Matheus",
      userAge: 27,
      counter: 0,
    };
    this.increase = this.increase.bind(this);
    this.decrease = this.decrease.bind(this);
  }

  increase() {
    let state = this.state;
    state.counter += 1;
    this.setState(state);
  }

  decrease() {
    let state = this.state;
    if (state.counter !== 0) {
      state.counter -= 1;
      this.setState(state);
    }
    state.userName = "José";
  }

  render() {
    return (
      <div>
        <h1>Teste aqui! {this.state.userName}</h1>
        <p>{this.state.userName}</p>
        <p>{this.state.counter}</p>
        <button onClick={this.decrease}> - </button>
        <button onClick={this.increase}> + </button>
      </div>
    );
  }
}

export default MyComponent;
