import React, { useState } from "react";
import "./App.css";

const App = () => {
  let [message, newMessage] = useState("Esta é uma mensagem comum");

  return (
    <div className="container">
      {message}
      <button
        onClick={() => {
          newMessage("Este é um texto feito por useState");
        }}
      >
        Clique em mim!
      </button>
    </div>
  );
};

export default App;
