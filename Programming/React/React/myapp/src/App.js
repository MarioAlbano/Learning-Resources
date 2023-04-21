import React from "react";

const MemberInfo = (props) => {
  return (
    <div>
      <MoreInfo
        name={props.name}
        charge={props.charge}
        age={props.age}
        linkedin={props.linkedin}
        youtube={props.youtube}
        instagram={props.instagram}
      />
    </div>
  );
};

const MoreInfo = (props) => {
  return (
    <div>
      <h2>Hello i'm {props.name}</h2>
      <h3>Charge: {props.charge}</h3>
      <h3>Age: {props.age}</h3>
      <Socials
        linkedin={props.linkedin}
        youtube={props.youtube}
        instagram={props.instagram}
      />
      <hr />
    </div>
  );
};

const Socials = (props) => {
  return (
    <h4>
      Linkedin = {props.linkedin}, Youtube = {props.youtube}, Instagram ={" "}
      {props.instagram}
    </h4>
  );
};

export default function App() {
  return (
    <div>
      <h1>Meet our team!</h1>
      <MemberInfo
        name="Joseph"
        charge="Pro Grammer"
        age="30"
        linkedin="1"
        youtube="2"
        instagram="3"
      />
      <MemberInfo
        name="Letícia"
        charge="Design"
        age="18"
        linkedin="1"
        youtube="2"
        instagram="3"
      />
    </div>
  );
}
//Stateless component it's a simple component, dont have life cycle and dont have state
