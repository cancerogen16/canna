import HTTP from '../../utils/HTTP';
import {addError} from '../error/action';
import {setUser, updateSalonUser} from './action';

export const setUserWithThunk = (user) => (dispatch, getState) => {
    dispatch(setUser(user));
}

export const updateSalonUserFetch = (user_id) => (dispatch, getState) => {
    HTTP.get(`api/users/${user_id}/salons`)
    .then(res => {dispatch(updateSalonUser(res.data.salons[0].id))})
    .catch(err => { 
        if (err.response) { 
            dispatch(addError({code: status, message: err.response.data.message})) 
        } else if (err.request) { 
            dispatch(addError({code: status, message: 'Не удается соединится с сервером'}))
        } else { 
            dispatch(addError({code: status, message: 'Что-то пошло не так'})) 
        }})
}