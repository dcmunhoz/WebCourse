import React from 'react';

export default class Contador extends React.Component{

    // Solução 1. Bind no construtor
    // constructor(props){

    //     super(props);
    //     this.maisUm = this.maisUm.bind(this);

    // }

    // Solução 2. Chama a função, dentro de uma arrow function
    // <button onClick={() => this.maisUm() }>+</button>

    // Solução 3. Cria a função como uma arrow function
    // maisUm = () => {
    //     // this.props.numero++;
    //     console.log(this);
    // }
    
    maisUm = () => {
        // this.props.numero++;
        console.log(this);
    }

    render() {
        return (
            <div>

                <div>Número: {this.props.numero}</div>
                <button onClick={this.maisUm}>+</button>
                <button>-</button>

            </div>
        )
    }

}