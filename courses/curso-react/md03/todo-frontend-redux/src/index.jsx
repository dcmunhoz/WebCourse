import React from 'react';
import ReactDOM from 'react-dom';
import { createStore } from 'redux';
import { Provider } from 'react-redux';

import App from './main/App';
import reducers from './main/reducers';

const devTools = window.__REDUX_DEVTOOLS_EXTENSION__ && window.__REDUX_DEVTOOLS_EXTENSION__()
ReactDOM.render(
    <Provider store={createStore(reducers, devTools)}>
        <App ></App>
    </Provider>
, document.querySelector("#app"));