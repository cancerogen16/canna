import HTTP from '../../utils/HTTP';
import { addError } from '../error/action';
import { clearSalon } from '../salon/action';
import { setUser, updateSalonUser } from './action';

export const setUserWithThunk = (user) => (dispach, getState) => {

    dispach(setUser(user));

}

export const updateSalonUserFetch = (user_id) => (dispach, getState) => {
    
    HTTP.get(`api/users/${user_id}/salons`)
    .then(res => {dispach(updateSalonUser(res.data.salons[0].id))})
    .catch(err => { 
        if (err.response) { 
            dispatch(addError({code: status, message: err.response.data.message})) 
        } else if (err.request) { 
            dispatch(addError({code: status, message: 'Не удается соединится с сервером'}))
        } else { 
            dispatch(addError({code: status, message: 'Что-то пошло не так'})) 
        }})

}