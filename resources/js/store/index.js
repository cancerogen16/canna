import { createStore, combineReducers, applyMiddleware } from 'redux';
import { profileReducer } from './profile/reducer';
import thunk from 'redux-thunk';
import authReducer from './auth/reducer';

const roorReducer = combineReducers({
    profile: profileReducer,
    auth: authReducer
})

export const store = createStore(roorReducer, applyMiddleware(thunk));