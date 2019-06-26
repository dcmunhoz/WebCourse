import React from 'react';
import ReactDOM from 'react-dom';
import Contador from './components/Contador';

ReactDOM.render(
    <Contador numero={0}/>
, document.querySelector("#root"));