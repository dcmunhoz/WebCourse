import React from 'react';
import ReactDOM from 'react-dom';
import { combineReducers, createStore } from 'redux';
import { Provider } from 'react-redux';

import InputForm from './components/InputForm';
import './index.css';

const reducers = combineReducers({
    field: () => ({value: 'Opa'})
});

ReactDOM.render(
    <Provider store={createStore(reducers)} >
        <InputForm initialValue="Nenhum Valor Digitado"/>
    </Provider>
, document.querySelector("#root"));