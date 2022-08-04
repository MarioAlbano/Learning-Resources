import { useState } from 'react'

const ListRender = () => {
    const [nomesFuncionarios] = useState(["Mario", "Hamilton", "Batshuayi"]);

    const [users, setUsers] = useState([
        { nome: "Mario", idade: 27, id: 1 },
        { nome: "Hamilton", idade: 43, id: 2 },
        { nome: "Batshuayi", idade: 28, id: 3 }
    ]);

    const deleteRandom = () => {
        const randomNumber = Math.floor(Math.random() * 4);

        setUsers((prevUsers) => {
            return prevUsers.filter((user) => randomNumber !== user.id)
        });
    };

    return (
        <div>
            <ul>
                {nomesFuncionarios.map(
                    (item, i) => <li key={i}>{item}</li>
                )}
            </ul>
            <button onClick={deleteRandom}>Deletar usuário</button>
        </div>
    )
}

export default ListRender