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

    state = {
        numero: this.props.numeroInicial
    };

    
    maisUm = () => {
        this.setState({ 
            numero: this.state.numero + 1
         });
        // console.log(this);
    }

    menosUm = () => {
        this.setState({
            numero: this.state.numero - 1
        });
    }

    render() {
        return (
            <div>

                <h1>Número: { this.state.numero }</h1>
                <button onClick={ this.maisUm  }>+</button>
                <button onClick={ this.menosUm }>-</button>

            </div>
        )
    }

}