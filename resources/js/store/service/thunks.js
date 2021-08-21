import HTTP from '../../utils/HTTP';
import {addService} from './action';
import { addServiceOne, delService } from '../services/action';
import { addError } from '../error/action';

export const fetchServiceOne = (service_id) => (dispach, getState) => {
    HTTP.get(`/api/services${service_id}`)
        .then(res => dispach(addService(res.data.service)))
        .catch(err => {
            if (err.response) {
                dispatch(addError({code: status, message: err.response.data.message}))
            } else if (err.request) {
                dispatch(addError({code: status, message: 'Не удается соединится с сервером'}))
            } else {
                dispatch(addError({code: status, message: 'Что-то пошло не так'}))
            }})
}

export const fetchUpdateService = (id,form) => (dispatch, getState) => {
    HTTP.put(`api/services/${id}`, form, {
        headers: {
            'Content-Type': 'multipart/form-data'
        }
    })
        .then(res => {
            // const service = res.data.service;
            // dispatch(addServiceOne(service));
            // dispatch(updateServiceSalon(service.id));
        })
}

export const fetchDeleteService = (id) => (dispatch) => {
    HTTP.delete(`api/services/${id}`)
        .then(res => dispatch(delService(id)))
        .catch(err => {
            if (err.response) {
                dispatch(addError({code: status, message: err.response.data.message}))
            } else if (err.request) {
                dispatch(addError({code: status, message: 'Не удается соединится с сервером'}))
            } else {
                dispatch(addError({code: status, message: 'Что-то пошло не так'}))
            }})
}

export const fetchCreateService = (form) => (dispatch, getState) => {
    HTTP.post('api/services', form, {
        headers: {
            'Content-Type': 'multipart/form-data'
        }
    })
        .then(res => {
            const service = res.data.service;
            dispatch(addServiceOne(service));
            // dispatch(updateServiceSalon(service.id));
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