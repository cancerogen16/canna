require('./bootstrap');

import React from 'react'
import {render} from 'react-dom'
import {Provider} from 'react-redux'
import Routes from './routes'
import { PersistGate } from 'redux-persist/integration/react'
import data from './store'
import { checkTokenStorage } from './store/auth/thunks';

const { store, persistor } = data();
store.dispatch(checkTokenStorage())

render((<Provider store={store}>
            <PersistGate loading={null} persistor={persistor}>
                <Routes/>  
            </PersistGate>
        </Provider>),
    document.getElementById('app'),
)