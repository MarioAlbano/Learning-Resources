import React, { Component } from "react";

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
        { userId: 3, userName: "Fabio", userLikes: "5", userComments: "1" },
      ],
    };
  }

  render() {
    return (
      <div>
        {this.state.myFeed.map((item) => {
          return (
            <div key={item.userId}>
              <h2>{item.userName}</h2>
              <a>Possui {item.userLikes} Likes</a> /{" "}
              <a>Possui {item.userComments} Comentários</a>
            </div>
          );
        })}
      </div>
    );
  }
}

export default App;
