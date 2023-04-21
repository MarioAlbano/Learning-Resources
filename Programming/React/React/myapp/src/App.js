import { Component } from "react";
import Member from "./components/Member";
class App extends Component {
  render() {
    return (
      <div>
        <Member name="Visitor" />
      </div>
    );
  }
}

export default App;
