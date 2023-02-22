import React, { Component } from "react";

export default class Feed extends Component {
  render() {
    return (
      <div>
        <h1>Nome: {this.props.userName}</h1>
        <li>
          {this.props.likes > 1
            ? "Likes: " + this.props.likes
            : "Like: " + this.props.likes}{" "}
          |{" "}
          {this.props.comments > 1
            ? "Comments: " + this.props.comments
            : "Comment: " + this.props.comments}
        </li>

        <hr />
      </div>
    );
  }
}
