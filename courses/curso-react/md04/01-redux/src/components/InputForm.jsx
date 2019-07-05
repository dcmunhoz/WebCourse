import React from 'react';
import {connect} from 'react-redux';
import './InputForm.css';
import { bindActionCreators } from 'redux';
import { changeValue } from './../action';


class InputForm extends React.Component {

    render(){

        return(
            <div className="form-group">
                <label htmlFor="input-text">Valor: <span id="value-type">{this.props.value}</span></label>
                <input onChange={this.props.changeValue} type="text" id="input-text" name="input-text"/>
            </div>
        )

    }

} 

function mapStateToProps(state){
    return {
        value: state.field.value
    }
}

function mapDispatchToProps(dispatch){
    return bindActionCreators({ changeValue }, dispatch)
}

export default connect(mapStateToProps, mapDispatchToProps)(InputForm);