import { Component } from "react";

class Member extends Component {
  constructor(props) {
    super(props);
    this.state = {
      name: props.name,
    };
    this.logIn = this.logIn.bind(this);
    this.logOff = this.logOff.bind(this);
  }

  logIn() {
    this.setState({ name: "João" });
  }

  logOff() {
    this.setState({ name: this.props.name });
  }

  render() {
    return (
      <div>
        <h2>Welcome {this.state.name}!</h2>
        <button onClick={this.logIn}>Log in on system</button>
        <button onClick={this.logOff}>Log off</button>
      </div>
    );
  }
}

export default Member;
