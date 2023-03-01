import React from "react";
import NewProps from "./NewProps";

//Component need to start with Uppercase. Lowercase means a HTML for React
function App() {
  return (
    <React.Fragment>
      <NewProps newText="Hong-Ming-Son" />
    </React.Fragment>
  );
}

export default App;
