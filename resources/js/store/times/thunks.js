import HTTP from '../../utils/HTTP';
import { addError } from '../error/action';
import { addTimeAll } from './action';

export const fetchTimesMaster = (master_id, date = '') => (dispatch, getState) => {
    HTTP.get(`/api/masters/${master_id}/calendars/${date}`)
    .then(res => {
        console.log(res);
        dispatch(addTimeAll(res.data.calendars));
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

export const fetchTimesUpdate = (id, record_id) => (dispatch, getState) => {
    HTTP.get(`/api/calendars/${id}`)
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

export const fetchRecorClear = (time, record) => (dispatch, getState) => {
    HTTP.post(`/api/records`, record)
    .then(res => {
        console.log(res);
        dispatch(fetchTimesUpdate(time.id, res.data.record.id))
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

