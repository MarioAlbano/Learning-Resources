export default function App() {
  return (
    <div>
      <h1>Teste</h1>
      <Student name={"Mario"} age={28} />
      <Student name={"Edgar"} age={18} />
      <Student name={"Edmilson"} age={50} />
    </div>
  );
}

interface AlunoProps {
  name: string;
  age: number;
}

function Student({ name, age }: AlunoProps) {
  return (
    <div>
      <h2>{name}</h2>
      <h3>{age}</h3>
    </div>
  );
}
