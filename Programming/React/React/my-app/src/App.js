import React, { Component } from "react";
import Feed from "./Feed";

class App extends Component {
  constructor(props) {
    super(props);
    this.state = {
      programFeed: [
        { id: 1, userName: "Mike", likes: 0, comments: 0 },
        { id: 2, userName: "Walter", likes: 50, comments: 25 },
        { id: 3, userName: "Jimmy", likes: 171, comments: 60 },
        { id: 4, userName: "My Grandmother", likes: 1, comments: 0 },
      ],
    };
  }

  render() {
    return (
      <div>
        {this.state.programFeed.map((item) => {
          return (
            <Feed
              key={item.id}
              userName={item.userName}
              likes={item.likes}
              comments={item.comments}
            />
          );
        })}
      </div>
    );
  }
}

export default App;
