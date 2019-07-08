import React from 'react';
import { connect } from 'react-redux';
import { bindActionCreators } from 'redux';
import { inc, dec, changeSteep } from './counterActions';
import './counter.css';

class Counter extends React.Component{

    render(){
        return(
            <div className="counter">
                <header>
                    <h1>Contador React + Redux</h1>
                </header>
                <section>
                    <div className="form-group">
                        <label htmlFor="steep">Steep: {this.props.value}</label>
                        <input defaultValue={this.props.steep} onChange={this.props.changeSteep} type="number" id="steep" name="steep" placeholder="Pular de quanto em quanto?"/>
                    </div>
                </section>
                <footer>
                    <button type="submit" onClick={this.props.inc} className="inc">+ Incrementar</button>
                    <button type="submit" onClick={this.props.dec} className="dec">- Decrementar</button>
                </footer>
            </div>
        );
    }

}

const mapStateToProps = (state) =>({ steep: state.counter.steep, value: state.counter.value });
const mapFuncToProps = (dispatch) => bindActionCreators({inc, dec, changeSteep}, dispatch);

export default connect(mapStateToProps, mapFuncToProps)(Counter);