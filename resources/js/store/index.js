import { createStore, combineReducers, applyMiddleware } from 'redux';
import { profileReducer } from './profile/reducer';
import thunk from 'redux-thunk';
import authReducer from './auth/reducer';
import {categoryReducer} from './category/reducer';
import {salonsReducer} from './salon/reducer';

const roorReducer = combineReducers({
    profile: profileReducer,
    auth: authReducer,
    categories: categoryReducer,
    salons: salonsReducer
})

export const store = createStore(roorReducer, applyMiddleware(thunk));