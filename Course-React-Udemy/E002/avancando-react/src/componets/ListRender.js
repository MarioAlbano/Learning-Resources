import { useState } from 'react'

const ListRender = () => {
    const [nomesFuncionarios] = useState(["Mario", "Hamilton", "Batshuayi"])

    return (
        <div>
            <ul>
                {nomesFuncionarios.map(
                    (item, i) => <li key={i}>{item}</li>
                )}
            </ul>
        </div>
    )
}

export default ListRender