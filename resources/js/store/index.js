import { createStore, combineReducers, applyMiddleware } from 'redux';
import { userReducer } from './user/reducer';
import thunk from 'redux-thunk';
import authReducer from './auth/reducer';
import {categoryReducer} from './category/reducer';
import {salonReducer} from './salon/reducer';
import { persistStore, persistReducer } from 'redux-persist'
import storage from 'redux-persist/lib/storage'
import { masterReducer } from './master/reducer';
import { mastersReducer } from './masters/reducer';
import { recordsReducer } from './records/reducer';
import {actionReducer} from "./action/reducer";
import { salonsReducer } from './salons/reducer';
import { servicesReducer } from './services/reducer';
const persistConfig = {
    key: 'canna',
    storage,
    whitelist: ['user']
  }



const rootReducer = combineReducers({
    user: userReducer,
    auth: authReducer,
    categories: categoryReducer,
    salons: salonsReducer,
    salon: salonReducer,
    master: masterReducer,
    masters: mastersReducer,
    records: recordsReducer,
    actions: actionReducer,
    services: servicesReducer
})

const persistedReducer = persistReducer(persistConfig, rootReducer)

//export const store = createStore(roorReducer, applyMiddleware(thunk));

export default () => {
    let store = createStore(persistedReducer, applyMiddleware(thunk))
    let persistor = persistStore(store)
    return { store, persistor }
  } 
