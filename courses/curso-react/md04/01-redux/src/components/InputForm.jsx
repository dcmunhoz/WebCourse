import React from 'react';
import './InputForm.css';

export default class InputForm extends React.Component {

    constructor(props){
        super(props);

        this.state = {

            value: props.initialValue
    
        }

        this.handleChange = this.handleChange.bind(this);

    }

    handleChange(e){
        let value = "";

        if(e.target.value.length === 0){
            value = this.props.initialValue;
        }else{
            value = e.target.value
        }


        this.setState({
            value
        });



    }

    render(){

        return(
            <div className="form-group">
                <label htmlFor="input-text">Valor: <span id="value-type">{this.state.value}</span></label>
                <input type="text" id="input-text" name="input-text" onChange={this.handleChange} />
            </div>
        )

    }

} 