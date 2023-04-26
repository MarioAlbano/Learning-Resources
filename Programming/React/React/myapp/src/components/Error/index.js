import { Link } from "react-router-dom";

function Error() {
  return (
    <div>
      <h1>Desculpe! Página não encontrada</h1>
      <h2>Acesse aqui as páginas de nossa empresa:</h2>
      <h3>
        <Link to="/">Página Home</Link>
        <Link to="/sobre">Sobre</Link>
        <Link to="/contato">Contato</Link>
      </h3>
    </div>
  );
}

export default Error;
