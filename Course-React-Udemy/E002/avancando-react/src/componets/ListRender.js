import { useState } from 'react';

const ListRender = () => {
    const [lista] = useState(["Mario", "Andrew", "Timo"])
    

    return (
        <div>
            <ul>
                {lista.map((item) => (
                    <li>{item}</li>
                ))}
            </ul>
        </div>
    )
}

export default ListRender