import React from 'react';
import ReactDOM from 'react-dom';
import Mensagem from './components/Exibir';

const element = document.querySelector("#root");
ReactDOM.render(
    <div>
        <Mensagem mensagem="Utilizando Props React" valor="Daniel" pow={2**8}/>        
    </div>    
, element);