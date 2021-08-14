import HTTP from '../../utils/HTTP';
import { addMastersAll } from './action';


export const fetchMasters = (salon_id) => (dispach, getState) => {

    HTTP.get('/api/masters')
    .then(res => dispach(addMastersAll(res.data.masters)) )
    .catch(err => { 
        if (err.response) { 
            dispatch(addError({code: status, message: err.response.data.email})) 
        } else if (err.request) { 
            dispatch(addError({code: status, message: 'Не удается соединится с сервером'}))
        } else { 
            dispatch(addError({code: status, message: 'Что-то пошло не так'})) 
        }})

}

export const fetchMastersOfSalon = (salon_id) => (dispach, getState) => {

    HTTP.get(`/api/salons/${salon_id}/masters`)
    .then(res => dispach(addMasters(res.data.masters))  )
    .catch(err => { 
        if (err.response) { 
            dispatch(addError({code: status, message: err.response.data.email})) 
        } else if (err.request) { 
            dispatch(addError({code: status, message: 'Не удается соединится с сервером'}))
        } else { 
            dispatch(addError({code: status, message: 'Что-то пошло не так'})) 
        }})
    
}