import React from "react";

//We can use component to avoid copy and paste many times the same code
function AppCard(props) {
  return (
    <div>
      <h1>Hello! {props.innerText}</h1>
    </div>
  );
}

export default AppCard;
