import MyComponent from './MyComponent';
//Para criar o componente, temos que criar a função e o retorno
const PrimeiroComponente = () => {
    return (
        <div>
            {/*Comentário*/}
            <h3>primeiroComponente</h3>
            <MyComponent />
        </div>
    );
};

//exportando para poder reutilizar
export default PrimeiroComponente;