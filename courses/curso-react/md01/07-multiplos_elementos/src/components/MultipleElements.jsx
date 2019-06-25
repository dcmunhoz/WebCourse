import React from 'react';

// Para exportar mais de um elemento, os mesmos devem
// estar em volta de uma div.
// Esta é a solução mais utilizada
export default props => (
    <div>
        <h1>Primeiro Elemento</h1>
        <h1>Segundo Elemento</h1>
    </div>
)

// Segunda opção utilizando React.Fragment
// export default props => (
//     <React.Fragment>
//         <h1>Primeiro Elemento</h1>
//         <h1>Segundo Elemento</h1>
//     </React.Fragment>
// )