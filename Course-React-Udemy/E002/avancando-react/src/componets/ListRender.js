import { useState } from 'react'

const ListRender = () => {
    const [nomesFuncionarios] = useState(["Mario", "Hamilton", "Batshuayi"])

    return (
        <div>
            <ul>
                {nomesFuncionarios.map(
                    (item) => <li>{item}</li>
                )}
            </ul>
        </div>
    )
}

export default ListRender