import HTTP from '../../utils/HTTP';
import { addError } from '../error/action';
import {addServices} from './action';

export const fetchServices = () => (dispach, getState) => {
    HTTP.get('/api/services')
        .then(res => dispach(addServices(res.data.services)))
        .catch(err => { 
            if (err.response) { 
                dispatch(addError({code: status, message: err.response.data.email})) 
            } else if (err.request) { 
                dispatch(addError({code: status, message: 'Не удается соединится с сервером'}))
            } else { 
                dispatch(addError({code: status, message: 'Что-то пошло не так'})) 
            }})
}

export const fetchServicesByMasterId = (master_id) => (dispach, getState) => {
    HTTP.get(`/api/services/${master_id}/masters`)
        .then(res => console.log(res))
        .catch(err => { 
            if (err.response) { 
                dispatch(addError({code: status, message: err.response.data.email})) 
            } else if (err.request) { 
                dispatch(addError({code: status, message: 'Не удается соединится с сервером'}))
            } else { 
                dispatch(addError({code: status, message: 'Что-то пошло не так'})) 
            }})
}

export const fetchServicesBySalonId = (salon_id) => (dispach, getState) => {
    HTTP.get(`/api/salons/${salon_id}/services`)
        .then(res => dispach(addServices(res.data.services)))
        .catch(err => { 
            if (err.response) { 
                dispatch(addError({code: status, message: err.response.data.message})) 
            } else if (err.request) { 
                dispatch(addError({code: status, message: 'Не удается соединится с сервером'}))
            } else { 
                dispatch(addError({code: status, message: 'Что-то пошло не так'})) 
            }})
}

export const fetchServicesOfSalon = (salon_id) => (dispach, getState) => {
    HTTP.get(`/api/salons/${salon_id}/masters`)
        .then(res => dispach(addServices(res.data.services)))
        .catch(err => { 
            if (err.response) { 
                dispatch(addError({code: status, message: err.response.data.message})) 
            } else if (err.request) { 
                dispatch(addError({code: status, message: 'Не удается соединится с сервером'}))
            } else { 
                dispatch(addError({code: status, message: 'Что-то пошло не так'})) 
            }})
}