import React from "react";

const Welcome = (props) => {
  return (
    <div>
      <h2>Bem vindo {props.name}</h2>
      <h2>Você tem {props.age} anos!</h2>
    </div>
  );
};

export default function App() {
  return (
    <div>
      <Welcome name="Carlos" age="30" />
      <Welcome name="Mariah" age="18" />
      <h1>Bem vindo ao sistema!</h1>
      <h2>Teste de h2 no React</h2>
    </div>
  );
}
//Stateless component it's a simple component, dont have life cycle and dont have state
