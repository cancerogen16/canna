import HTTP from '../../utils/HTTP';
import {addMaster} from './action';
import {updateMasterSalon} from "../salon/action";
import { addMasterOne } from '../masters/action';
import { addError } from '../error/action';

export const fetchMasterOne = (master_id) => (dispach, getState) => {
    HTTP.get(`/api/masters${master_id}`)
        .then(res => dispach(addMaster(res.data.master)))
        .catch(err => { 
            if (err.response) { 
                dispatch(addError({code: status, message: err.response.data.message})) 
            } else if (err.request) { 
                dispatch(addError({code: status, message: 'Не удается соединится с сервером'}))
            } else { 
                dispatch(addError({code: status, message: 'Что-то пошло не так'})) 
            }})
}

export const fetchCreateMaster = (form) => (dispatch, getState) => {
    HTTP.post('api/masters', form, {
        headers: {
            'Content-Type': 'multipart/form-data'
        }
    })
        .then(res => {
            const master = res.data.master;
            dispatch(addMasterOne(master));
            dispatch(updateMasterSalon(master.id));
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