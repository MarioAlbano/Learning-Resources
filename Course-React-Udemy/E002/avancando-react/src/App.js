import './App.css';
import Img1 from "./assets/img1.jpg"

function App() {
  return (
    <div className="div-grid">
      <h1>Aprendendo React</h1>
      <img src="/img1.jpg" alt="Uma paisagem ao nascer do sol" />
      <div>
        <img src={Img1} alt="" />
      </div>

    </div >

  );
}

export default App;
