import { Link } from "react-router-dom";

function Contact() {
  return (
    <div>
      <h1>Página de contato</h1>
      <span>Telefone da empresa: (dd) 1234-4321</span>

      <Link to={"/sobre"}>Sobre</Link>
      <br />
      <Link to={"/"}>Página inicial</Link>
    </div>
  );
}

export default Contact;
