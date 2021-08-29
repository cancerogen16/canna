import HTTP from '../../utils/HTTP';
import { addError } from '../error/action';
import { addTimeAll } from './action';

export const fetchRecorClear = (record) => (dispatch, getState) => {
    HTTP.post(`/api/records`, record)
    .then(res => {
        console.log(res);
        //dispatch(addTimeAll(res.data.calendars));
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
