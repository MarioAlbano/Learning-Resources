import "./test.css";

interface testProps {
  name: string;
  age: number;
  email: string;
}

export function Test({ name, age }: testProps) {
  return (
    <div className="div-class">
      <h2>Este é um componente reutilizável</h2>
      <h3>
        {name} {age} teste
      </h3>
    </div>
  );
}
