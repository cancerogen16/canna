import HTTP from '../../utils/HTTP';
import {addSalons} from './action';

export const fetchSalonsAll = () => (dispatch, getState) => {
    HTTP.get('api/salons')
        .then(res => {
            dispatch(addSalons(res.data.salons))
        })
        .catch(err => { 
            if (err.response) { 
                dispatch(addError({code: status, message: err.response.data.email})) 
            } else if (err.request) { 
                dispatch(addError({code: status, message: 'Не удается соединится с сервером'}))
            } else { 
                dispatch(addError({code: status, message: 'Что-то пошло не так'})) 
            }})
}