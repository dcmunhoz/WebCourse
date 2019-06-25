import React from 'react';
import ReactDOM from 'react-dom';
import { CompA, CompB as B } from './components/MultipleComponents';

ReactDOM.render(
    <div>
        <CompA valorA="Olá, eu sou A" />
        <B valorB="B é o cara." />
    </div>
, document.querySelector("#root"));