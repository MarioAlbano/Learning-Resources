import React from "react";
import Task from "./Task";

const Tasks = ({ tasks }) => {
  return (
    <>
      {tasks.map((task) => (
        <p key={task.id}>
          <Task tasks={task} />
        </p>
      ))}
    </>
  );
};

export default Tasks;
