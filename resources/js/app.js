require('./bootstrap');

import React from 'react'
import {render} from 'react-dom'
import {Provider, useDispatch} from 'react-redux'

import Routes from './routes'
import {authCheck, authLogin, checkTokenStorage} from './store/auth/actions';
import { PersistGate } from 'redux-persist/integration/react'
import data from './store'
const { store, persistor } = data();
store.dispatch(checkTokenStorage())

render((<Provider store={store}>
            <PersistGate loading={null} persistor={persistor}>
                <Routes/>  
            </PersistGate>
        </Provider>),
    document.getElementById('app'),
)