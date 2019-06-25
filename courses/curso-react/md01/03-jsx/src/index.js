import React from 'react';
import ReactDOM from 'react-dom';

// Criando lista com React 
const elemento = document.querySelector("#root");
ReactDOM.render(
    <ul>
        <li>1) Pedro</li>
        <li>2) Ana</li>
        <li>3) Daniel</li>        
    </ul>
, elemento);

// Criando lista com JS Puro
// const elemento = document.querySelector("#root");

// const lista = document.createElement('ul');
// let item = document.createElement('li');
// let text = document.createTextNode("1) Pedro");
// item.appendChild(text);
// lista.appendChild(item);
// elemento.appendChild(lista);

// item = document.createElement('li');
// text = document.createTextNode("2) Ana");
// item.appendChild(text);
// lista.appendChild(item);
// elemento.appendChild(lista);

// item = document.createElement('li');
// text = document.createTextNode("3) Daniel");
// item.appendChild(text);
// lista.appendChild(item);
// elemento.appendChild(lista);
