import React from 'react';
import ReactDOM from 'react-dom';
import './index.css';
import App from './App';
import * as serviceWorker from './serviceWorker';
import thunk from 'redux-thunk';
import { createStore , combineReducers , compose, applyMiddleware } from 'redux';
import { Provider } from 'react-redux';
import userReducer from './reducers/userReducer';
import projectReducer from './reducers/projectReducer';

const allEnhancers = compose(
    applyMiddleware(thunk)
);

const rootReducer = combineReducers({
   userReducer, projectReducer
});


const store = createStore(rootReducer, {}, allEnhancers);



ReactDOM.render(<Provider store={store}><App /></Provider>, document.getElementById('root'));

// If you want your app to work offline and load faster, you can change
// unregister() to register() below. Note this comes with some pitfalls.
// Learn more about service workers: https://bit.ly/CRA-PWA
serviceWorker.unregister();
