import React, { useState } from "react";
import "./App.css";
import Tasks from "./components/Tasks";

const App = () => {
  const [tasks] = useState([
    { id: "1", nome: "Mario" },
    { id: "2", nome: "João" },
  ]);

  return (
    <div className="container">
      <Tasks tasks={tasks} />
    </div>
  );
};

export default App;
