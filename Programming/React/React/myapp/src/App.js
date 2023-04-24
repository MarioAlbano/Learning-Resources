import React, { Component } from "react";
import "./style.css";
class App extends Component {
  constructor(props) {
    super(props);
    this.state = {
      number: 0,
      timer: 0,
      buttonStart: "Go",
    };
    //binding functions
    this.startClock = this.startClock.bind(this);
    this.stopClock = this.stopClock.bind(this);
  }

  //clock start
  startClock() {
    //Using a variable 'timer' to pause the timer with clearInterval.

    if (this.timer != null) {
      clearInterval(this.timer);
      this.state.buttonStart = "Go";
      this.timer = null;
      this.setState(this.state);
    } else {
      this.timer = setInterval(() => {
        let state = this.state;
        state.number += 0.1;
        state.buttonStart = "Pause";
        this.setState(state);
      }, 100);
    }
  }

  //Stopping clock
  stopClock() {
    if (
      this.timer !== null ||
      (this.timer === null && this.state.buttonStart === "Go")
    ) {
      let state = this.state;
      clearInterval(this.timer);
      this.timer = null;
      state.number = 0;
      state.buttonStart = "Go";
      this.setState(state);
    }
  }

  render() {
    return (
      <div className="main-container">
        <img src={require("./cronometro.png")} className="clock-img" />
        <a className="timer-display">{this.state.number.toFixed(2)}</a>
        <div className="area-button">
          <a className="button-clock" onClick={this.startClock}>
            {this.state.buttonStart}
          </a>
          <a className="button-clock" onClick={this.stopClock}>
            Stop
          </a>
        </div>
      </div>
    );
  }
}

export default App;
