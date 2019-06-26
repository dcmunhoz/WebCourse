import React from 'react';


export default props => {

    const aprovados = ["Paula", 'Roberta', 'Gustavo', 'Julia'];
    
    const gerarItem = itens =>{

        return itens.map(item => <li>{item}</li>)

    }

    return (
        <ul>
            {gerarItem(aprovados)}
        </ul>
    )

}