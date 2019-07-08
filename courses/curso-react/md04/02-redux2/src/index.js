import React from 'react';
import ReactDOM from 'react-dom';
import Counter from './Components/counter/Counter';
import {combineReducers, createStore } from 'redux';
import { Provider } from 'react-redux';
import counterReducer from './Components/counter/counterReducers';

import './index.css';

const reducer = combineReducers({
    counter: counterReducer
});

ReactDOM.render(
    <Provider store={createStore(reducer)}>
        <Counter></Counter>    
    </Provider>
, document.querySelector("#root"));

