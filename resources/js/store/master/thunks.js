import HTTP from '../../utils/HTTP';
import {addMaster} from './action';
import {addMasterOne, delMaster, updateMaster} from '../masters/action';
import {addError} from '../error/action';

export const fetchMasterOne = (master_id) => (dispatch, getState) => {
    HTTP.get(`/api/masters${master_id}`)
        .then(res => dispatch(addMaster(res.data.master)))
        .catch(err => { 
            if (err.response) { 
                dispatch(addError({code: status, message: err.response.data.message})) 
            } else if (err.request) { 
                dispatch(addError({code: status, message: 'Не удается соединится с сервером'}))
            } else { 
                dispatch(addError({code: status, message: 'Что-то пошло не так'})) 
            }})
}

export const fetchUpdateMaster = (id,form) => (dispatch, getState) => {
    HTTP.post(`api/masters/${id}?_method=PUT`, form)
    .then(res => {
        dispatch(updateMaster(res.data.master));
    })
}

export const fetchDeleteMaster = (id) => (dispatch) => {
    HTTP.delete(`api/masters/${id}`)
        .then(res => dispatch(delMaster(id)))
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
    HTTP.post('api/masters', form)
        .then(res => {
            const master = res.data.master;
            dispatch(addMasterOne(master));
           // dispatch(updateMasterSalon(master.id));
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