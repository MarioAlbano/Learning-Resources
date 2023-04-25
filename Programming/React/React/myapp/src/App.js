import React, { useState, useEffect } from "react";
import "./style.css";
//https://sujeitoprogramador.com/rn-api/?api=posts

function App() {
  const [nutri, setNutri] = useState([]);

  useEffect(() => {
    function loadApi() {
      let url = "https://sujeitoprogramador.com/rn-api/?api=posts";
      fetch(url)
        .then((r) => r.json())
        .then((json) => {
          console.log(json);
          setNutri(json);
        });
    }
    loadApi();
    console.log(nutri);
  }, []);

  return (
    <div className="container">
      <header>
        <strong>Nutrição Informação</strong>
      </header>

      {nutri.map((item) => {
        return (
          <article key={item.id} className="posts">
            <strong className="title">{item.titulo}</strong>
            <img src={item.capa} alt="Capa do título" className="cover" />
            <p className="subtitle">{item.subtitulo}</p>
            <h4>Categoria: {item.categoria}</h4>
            <a href="" className="button">
              Acessar
            </a>
          </article>
        );
      })}
    </div>
  );
}

export default App;
