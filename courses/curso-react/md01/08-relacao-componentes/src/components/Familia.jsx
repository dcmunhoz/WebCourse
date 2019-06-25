import React from 'react';
import { childProps } from './utils/util';

export default (props) => (
    <div>
        <header>
            <h1>Familia { props.sobrenome}</h1>
        </header>
        <section>

            {childProps(props)}

            {/* {React.Children.map(props.children, child=>{
                return React.cloneElement(child, { ...props })
            })} */}

            {/* {React.cloneElement(props.children, { ...props })} */}
            {/* {React.cloneElement(props.children, props)} */}
            {/* {props.children} */}
        </section>
    </div>
)