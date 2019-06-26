import React from 'react';
import ReactDOM from 'react-dom';
import Contador from './components/Contador';

ReactDOM.render(
    <Contador numeroInicial={100}/>
, document.querySelector("#root"));