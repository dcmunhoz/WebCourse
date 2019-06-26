import React from 'react';

export default class Contador extends React.Component{

    maisUm(){
        this.props.numero++;
    }

    render() {
        return (
            <div>

                <div>Número: {this.props.numero}</div>
                <button onClick={this.maisUm }>+</button>
                <button>-</button>

            </div>
        )
    }

}