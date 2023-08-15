interface FooterInterface {
  law?: string;
}

export function Footer({ law = "Sem lei" }: FooterInterface) {
  return <p>Todos os direitos reservados {`Lei número ${law}`}</p>;
}
