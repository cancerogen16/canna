import { createStore, combineReducers, applyMiddleware } from 'redux';
import { profileReducer } from './profile/reducer';
import thunk from 'redux-thunk';

const roorReducer = combineReducers({
    profile: profileReducer
})

export const store = createStore(roorReducer, applyMiddleware(thunk));