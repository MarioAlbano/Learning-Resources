import React, { useState, useEffect, useMemo, useCallback } from "react";

function App() {
  const [tasks, setTasks] = useState(["Pay bills", "Study Hooks in React"]);

  const [input, setInput] = useState("");

  //it's like componetDidUpdate or componentDidMount. Every uptade we can trigger a function
  useEffect(() => {
    const tasksStorage = localStorage.getItem("tasks");

    if (tasksStorage) {
      setTasks(JSON.parse(tasksStorage));
    }
  }, []);

  useEffect(() => {
    localStorage.setItem("tasks", JSON.stringify(tasks));
  }, [tasks]);

  //Using useCallback to prevent unnecessary re-renders from functions
  const handleAdd = useCallback(() => {
    setTasks([...tasks, input]);
    setInput("");
  }, [tasks, input]);

  //We can use useMemo to avoid unnecessary re-renders
  const sumTasks = useMemo(() => tasks.length, [tasks]);

  const handleKeyPress = (event) => {
    if (event.key === "Enter") {
      handleAdd();
    }
  };

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
        onKeyDown={handleKeyPress}
      />
      <button onClick={handleAdd}>Adicionar uma tarefa</button>
      <h3>Você tem {sumTasks} tarefas!</h3>
    </div>
  );
}
export default App;
