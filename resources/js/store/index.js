import { createStore, combineReducers, applyMiddleware } from 'redux';
import { userReducer } from './user/reducer';
import thunk from 'redux-thunk';
import authReducer from './auth/reducer';
import {categoryReducer} from './category/reducer';
import {salonsReducer} from './salon/reducer';
import { persistStore, persistReducer } from 'redux-persist'
import storage from 'redux-persist/lib/storage'
const persistConfig = {
    key: 'canna',
    storage,
    
  }



const rootReducer = combineReducers({
    user: userReducer,
    auth: authReducer,
    categories: categoryReducer,
    salons: salonsReducer,
})

const persistedReducer = persistReducer(persistConfig, rootReducer)

//export const store = createStore(roorReducer, applyMiddleware(thunk));

export default () => {
    let store = createStore(persistedReducer, applyMiddleware(thunk))
    let persistor = persistStore(store)
    return { store, persistor }
  } 
