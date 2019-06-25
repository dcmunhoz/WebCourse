import React from 'react';

let isLegal = true;

export default (props) => (
    <div>    
        <h1>{props.mensagem}</h1>
        <h2>Olá {props.valor}</h2>
        <h2>Math Power = {props.pow}</h2>
        <p>Legal? {isLegal ? "Sim" : "Não"}</p>
        <p>{Math.ceil(Math.random() * 100)}</p>
    </div>
)