import React from 'react';

export default (props) => (
    <div>
        <header>
            <h1>Familia { props.sobrenome}</h1>
        </header>
        <section>
            {props.children}
        </section>
    </div>
)