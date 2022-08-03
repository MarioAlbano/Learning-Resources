//Arquivos Componentes
import PrimeiroComponente from './components/primeiroComponente';
import TemplateExpressions from './components/TemplateExpressions';
import Events from './components/Events';
//Arquivos CSS
import './App.css';

function App() {
  return (
    <div className="App">
      <section className="section-react">
        <h1>Hello World! Teste de fast reloaded</h1>
        <PrimeiroComponente />
        <h2>Testando o emmet no react</h2>
        <TemplateExpressions />
        <Events />
      </section>
    </div>
  );
}

export default App;