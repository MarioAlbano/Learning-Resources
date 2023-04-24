import React, { useState } from "react";

function App() {
  const [tasks, setTasks] = useState(["Pay bills", "Study Hooks in React"]);

  const [input, setInput] = useState("");

  function handleAdd() {
    setTasks([...tasks, input]);
    setInput("");
  }

  return (
    <div>
      <ul>
        {tasks.map((item) => (
          <li key={item}>{item}</li>
        ))}
      </ul>
      <input
        type="text"
        value={input}
        onChange={(e) => setInput(e.target.value)}
      />
      <button onClick={handleAdd}>Adicionar uma tarefa</button>
    </div>
  );
}
export default App;
