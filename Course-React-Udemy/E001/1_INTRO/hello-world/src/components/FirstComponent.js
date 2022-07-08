//Arquivo de estilo

import MyComponent from "./MyComponent";
import TemplateExpressions from "./TemplateExpressions";

const FirstComponent = () => {
    //Essa função cria meu primeiro componente
    return (
        < div >
            <MyComponent />
            <h1>Meu primeiro componente</h1>
            {/*ESte é um comentário JSX*/}
        </div >
    );
};

export default FirstComponent;