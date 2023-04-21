import { Component } from "react";

class App extends Component {
  constructor(props) {
    super(props);
    this.state = {
      date: "00:00:00",
    };
  }

  //Creating a componentDidMount, using a set interval with functions to get data time
  componentDidMount() {
    setInterval(() => {
      this.setState({ date: new Date().toLocaleTimeString() });
    }, 1000);
  }

  //Creating a componentDidUpdate and using one clg for each update that "date" have
  componentDidUpdate() {}

  render() {
    return (
      <div>
        <h1>{this.state.date}</h1>
      </div>
    );
  }
}

export default App;
