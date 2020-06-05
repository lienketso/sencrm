import React from 'react';
import ReactDOM from 'react-dom';
import {Provider} from 'react-redux';
import {createStore, compose, applyMiddleware} from 'redux';
import thunkMiddleware from 'redux-thunk';
import MainReducer from "./modules/reducers/MainReducer";
import Main from "./modules/Main";

const composeEnhancers = window.__REDUX_DEVTOOLS_EXTENSION_COMPOSE__ || compose;

const store = createStore(
    MainReducer,
    composeEnhancers(
        applyMiddleware(thunkMiddleware),
    )
)

ReactDOM.render(
    <Provider store={store}>
        <Main/>
    </Provider>,
    document.getElementById('menuModule')
);