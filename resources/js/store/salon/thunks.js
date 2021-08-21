import HTTP from '../../utils/HTTP';
import {updateSalonUser} from '../user/action';
import {addSalon, clearSalon} from './action';
import {addMastersAll} from "../masters/action";
import {addServicesAll} from "../services/action";
import {addAction} from "../action/action";
import { addError } from '../error/action';

export const fetchCreateSalon = (form) => (dispatch, getState) => {
    HTTP.post('api/salons', form, {
        headers: {
            'Content-Type': 'multipart/form-data'
        }
    })
        .then(res => {
            const salon = res.data.salon;
            dispatch(addSalon(salon));
            dispatch(updateSalonUser(salon.id));
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

export const fetchSalonByUserId = (user_id) => (dispatch, getState) => {
    HTTP.get(`api/users/${user_id}/salons`)
        .then(res => dispatch(addSalon(res.data.salons[0])))
        .catch(err => { 
            if (err.response) { 
                dispatch(addError({code: status, message: err.response.data.message})) 
            } else if (err.request) { 
                dispatch(addError({code: status, message: 'Не удается соединится с сервером'}))
            } else { 
                dispatch(addError({code: status, message: 'Что-то пошло не так'})) 
            }})
}

export const fetchSalonsOneId = (id) => (dispatch, getState) => {
    HTTP.get(`/api/salons/${id}`)
        .then(res => {
            if (res.data.code) {
                dispatch(clearSalon())
            } else {
                console.log('sad', res)
                dispatch(addSalon(res.data.salon))
            }
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

export const fetchSalonInfo = (id) => (dispatch, getState) => {
    HTTP.get(`/api/salons/${id}/info`)
        .then(res => {
            if (res.data.code) {
                dispatch(clearSalon())
            } else {
                dispatch(addSalon(res.data.salon));
                dispatch(addServicesAll(res.data.salon.services));
                dispatch(addMastersAll(res.data.salon.masters));
                dispatch(addAction(res.data.salon.actions));
            }
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
