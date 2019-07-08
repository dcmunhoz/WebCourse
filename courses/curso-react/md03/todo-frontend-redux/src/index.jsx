import React from 'react';
import ReactDOM from 'react-dom';
import { createStore } from 'redux';
import { Provider } from 'react-redux';

import App from './main/App';
import reducers from './main/reducers';

ReactDOM.render(
    <Provider store={createStore(reducers)}>
        <App ></App>
    </Provider>
, document.querySelector("#app"));