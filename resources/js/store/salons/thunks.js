import HTTP from '../../utils/HTTP';
import { addError } from '../error/action';
import {addSalons} from './action';

export const fetchSalonsAll = () => (dispatch, getState) => {
    HTTP.get('api/salons')
        .then(res => {
            dispatch(addSalons(res.data.salons))
        })
        .catch(err => { 
            
            if (err.response) {  
                dispatch(addError({code: status, message: err.response.data.message})) 
            } else if (err.request) {
                dispatch(addError({code: status, message: 'Не удается соединится с сервером'}))
            } else { 
                dispatch(addError({code: status, message: 'Что-то пошло не так'})) 
            }})
}