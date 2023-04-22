import React, { Component } from "react";
import Feed from "./components/Feed";

class App extends Component {
  constructor(props) {
    super(props);
    this.state = {
      myFeed: [
        { userId: 1, userName: "Mario", userLikes: "100", userComments: "12" },
        {
          userId: 2,
          userName: "Lucas",
          userLikes: "1000",
          userComments: "500",
        },
        { userId: 3, userName: "Fabio", userLikes: "5", userComments: "2" },
        { userId: 4, userName: "Anastásio", userLikes: "1", userComments: "1" },
      ],
    };
  }

  render() {
    return (
      <div>
        {this.state.myFeed.map((item) => {
          return (
            <Feed
              id={item.userId}
              name={item.userName}
              likes={item.userLikes}
              comments={item.userComments}
            />
          );
        })}
      </div>
    );
  }
}

export default App;
