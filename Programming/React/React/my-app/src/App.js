const SocialMembers = (props) => {
  return (
    <div>
      <p>
        Aqui está o social {props.SocialOne}, {props.SocialTwo},{" "}
        {props.SocialThree}
      </p>{" "}
      <a href={props.Link} target="_blank">
        Link para o Google aqui!
      </a>
    </div>
  );
};

const WelcomeTeam = (props) => {
  return (
    <div>
      <About
        TeamName={props.Tname}
        MemberOne={props.MemberOne}
        MemberTwo={props.MemberTwo}
        MemberThree={props.MemberThree}
      />
      <SocialMembers
        SocialOne={props.SocialOne}
        SocialTwo={props.SocialTwo}
        SocialThree={props.SocialThree}
        Link={props.Link}
      />
      <hr />
    </div>
  );
};

const About = (props) => {
  return (
    <div>
      <h1>Olá, o nome do time é {props.TeamName}</h1>
      <h2>
        O time é composto por {props.MemberOne}, {props.MemberTwo} e{" "}
        {props.MemberThree}.
      </h2>
    </div>
  );
};

export default function App() {
  return (
    <div>
      <h1>Meet our team!</h1>
      <WelcomeTeam
        Tname="Alpha Team"
        MemberOne="Jonny"
        MemberTwo="Sarah"
        MemberThree="Mike"
        SocialOne="Insta"
        SocialTwo="Discord"
        SocialThree="Youtube"
        Link="https://www.google.com"
      />
    </div>
  );
}
