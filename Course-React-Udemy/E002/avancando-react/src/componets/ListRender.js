import { useState } from 'react'


//Necessário refazer exercício
const ListRender = () => {
    const [nomesFuncionarios] = useState(["Mario", "Hamilton", "Batshuayi"]);
    const [users, setUsers] = useState([
        { id: 1, name: "Matheus", age: 31 },
        { id: 2, name: "Jones", age: 19 },
        { id: 3, name: "Scorpion", age: 201 },
    ]);

    const deleteRandom = () => {
        const randomNumber = Math.floor(Math.random() * 4);

        setUsers((prevUsers) => {
            return prevUsers.filter((user) => randomNumber !== user.id);
        });
    };

    return (
        <div>
            <ul>
                {nomesFuncionarios.map(
                    (item, i) => <li key={i}>{item}</li>
                )}
            </ul>
            <ul>
                {users.map((user) => (
                    <li key={user.id}>
                        {user.name} - {user.age} anos
                    </li>
                ))}
            </ul>
            <button onClick={deleteRandom}>Deletar usuário</button>
        </div>
    )
}

export default ListRender