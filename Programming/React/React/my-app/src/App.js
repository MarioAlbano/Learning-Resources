import React from "react";

class App extends React.Component {
  constructor(props) {
    super(props);
    this.state = {
      hour: "00.00.00",
    };
  }

  componentDidMount() {
    setInterval(() => {
      this.setState({ hour: new Date().toLocaleTimeString() });
    }, 1000);
  }

  render() {
    return <h1>Projeto hora em React: {this.state.hour}</h1>;
  }
}

export default App;
