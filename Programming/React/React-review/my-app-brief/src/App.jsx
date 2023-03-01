import React from "react";
import AppCard from "./Card";

//Component need to start with Uppercase. Lowercase means a HTML for React
function App() {
  return (
    <React.Fragment>
      <h1>It's just another test using fragment!</h1>
      <AppCard innerText="John" />
      <AppCard innerText="Maria" />
      <AppCard innerText="Heong-Ming-Son" />
    </React.Fragment>
  );
}

export default App;
