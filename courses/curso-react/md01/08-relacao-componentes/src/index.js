import React from 'react';
import ReactDOM from 'react-dom';
// import Silva from './components/FamiliaSilva';
import Familia from './components/Familia';
import Membro from './components/Membro';

ReactDOM.render(
    <div>
        <Familia sobrenome="Munhoz">
            <Membro nome="Daniel"  />
            <Membro nome="Renata"  />
        </Familia>

        <Familia sobrenome="Pereira">
            <Membro nome="Carlos" />
            <Membro nome="Ana" />
        </Familia>

        {/* <Silva /> */}
    </div>
, document.querySelector("#root"));