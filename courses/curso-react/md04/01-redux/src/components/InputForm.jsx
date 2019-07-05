import React from 'react';
import {connect} from 'react-redux';
import './InputForm.css';

class InputForm extends React.Component {

    render(){

        return(
            <div className="form-group">
                <label htmlFor="input-text">Valor: <span id="value-type">{this.props.value}</span></label>
                <input type="text" id="input-text" name="input-text" onChange={this.handleChange} />
            </div>
        )

    }

} 

function mapStateToProps(state){
    return {
        value: state.field.value
    }
}

export default connect(mapStateToProps)(InputForm);