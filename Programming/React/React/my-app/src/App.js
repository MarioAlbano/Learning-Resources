//Creating component without {} and return
const MyFirstComponent = (props) => (
  <h2>
    Este é meu {props.userName} componente! Este aqui é um props:
    {props.userProps}
  </h2>
);

//Creating component with {} and return
const MySecondComponent = () => {
  return (
    <div>
      <h3>Este é meu segundo componente em React!</h3>
    </div>
  );
};

export default function App() {
  return (
    <div>
      <h1>Olá mundo!</h1>
      <MyFirstComponent userName="Pr1meiro" userProps="Pr0ps" />
      <MyFirstComponent userName="S3gund0" userProps="Pro0ps 02" />
      <MySecondComponent />
      <p>
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium,
        quo dolor? Quos ducimus voluptas inventore similique voluptate, delectus
        laborum excepturi officia rerum, commodi, animi consequuntur ipsum
        voluptatem provident ratione odio!
      </p>
    </div>
  );
}
