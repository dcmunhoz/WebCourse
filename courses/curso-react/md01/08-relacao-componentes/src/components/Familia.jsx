import React from 'react';

export default (props) => (
    <div>
        <header>
            <h1>Familia { props.sobrenome}</h1>
        </header>
        <section>
            {React.cloneElement(props.children, { ...props })}
            {/* {React.cloneElement(props.children, props)} */}
            {/* {props.children} */}
        </section>
    </div>
)