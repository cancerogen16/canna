import HTTP from '../../utils/HTTP';
import {addError} from '../error/action';
import {addMastersAll} from './action';

export const fetchMasters = (salon_id) => (dispatch, getState) => {
    HTTP.get('/api/masters')
    .then(res => dispatch(addMastersAll(res.data.masters)) )
    .catch(err => { 
        if (err.response) { 
            dispatch(addError({code: status, message: err.response.data.message})) 
        } else if (err.request) { 
            dispatch(addError({code: status, message: 'Не удается соединится с сервером'}))
        } else { 
            dispatch(addError({code: status, message: 'Что-то пошло не так'})) 
        }})
}

export const fetchMastersOfSalon = (salon_id) => (dispatch, getState) => {
    HTTP.get(`/api/salons/${salon_id}/masters`)
    .then(res => dispatch(addMasters(res.data.masters))  )
    .catch(err => { 
        if (err.response) { 
            dispatch(addError({code: status, message: err.response.data.message})) 
        } else if (err.request) { 
            dispatch(addError({code: status, message: 'Не удается соединится с сервером'}))
        } else { 
            dispatch(addError({code: status, message: 'Что-то пошло не так'})) 
        }})
}