import { Component } from "react";

class Feed extends Component {
  render() {
    return (
      <div key={this.props.id}>
        <h2>Nome: {this.props.name}</h2>
        {this.props.likes > 1 ? (
          <a>Curtidas: {this.props.likes}</a>
        ) : (
          <a>Curtida: {this.props.likes}</a>
        )}{" "}
        /{" "}
        {this.props.comments > 1 ? (
          <a>Comentários: {this.props.comments}</a>
        ) : (
          <a>Comentário: {this.props.comments}</a>
        )}
      </div>
    );
  }
}

export default Feed;
